<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\NewMessage;
use App\Events\UserTyping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    /**
     * Show the main messages view with conversations and messages.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $recipientId = $request->recipient_id ?? null;
        $recipient = $recipientId ? User::findOrFail($recipientId) : null;

        // Get all unique conversations
        $conversations = $this->getUserConversations($user);

        // Get messages for the selected recipient
        $messages = $recipient ? $this->getConversationMessages($user->id, $recipientId) : collect();

        return view('messages.index', [
            'conversations' => $conversations,
            'messages' => $messages,
            'recipient' => $recipient,
            'recipientId' => $recipientId
        ]);
    }

    /**
     * Show chat with a specific recipient.
     */
    public function chat($recipient_id)
    {
        $recipient = User::findOrFail($recipient_id);

        // Authorization check
        if (!$this->canChatWith(auth()->user(), $recipient)) {
            abort(403, 'Unauthorized action.');
        }

        $messages = $this->getConversationMessages(auth()->id(), $recipient_id);

        // Mark messages as read
        $this->markMessagesAsRead(auth()->id(), $recipient_id);

        return view('messages.index', [
            'recipient' => $recipient,
            'messages' => $messages,
            'conversations' => $this->getUserConversations(auth()->user())
        ]);
    }

    /**
     * Send a new message.
     */
    public function sendMessage(Request $request)
    {
        $validator = $this->validateMessageRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $message = $this->createMessage($request);

            broadcast(new NewMessage($message))->toOthers();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Message sending failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message'
            ], 500);
        }
    }

    /**
     * Set user online status.
     */
    public function setOnline()
    {
        Cache::put('user_online_' . auth()->id(), true, now()->addMinutes(5));
        return response()->json(['status' => 'Online']);
    }

    /**
     * Set user offline status.
     */
    public function setOffline()
    {
        Cache::forget('user_online_' . auth()->id());
        return response()->json(['status' => 'Offline']);
    }

    /**
     * Handle typing indicator.
     */
    public function typing($recipient_id)
    {
        broadcast(new UserTyping(auth()->id(), $recipient_id))->toOthers();
        return response()->json(['status' => 'Typing...']);
    }

    /**
     * Get unread messages count.
     */
    public function unreadCount()
    {
        $count = Message::where('recipient_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Get all unique conversations for a user.
     */
    protected function getUserConversations(User $user)
    {
        return Message::where('sender_id', $user->id)
            ->orWhere('recipient_id', $user->id)
            ->with(['sender', 'recipient'])
            ->latest()
            ->get()
            ->groupBy(function ($msg) use ($user) {
                return $msg->sender_id == $user->id ? $msg->recipient_id : $msg->sender_id;
            })
            ->map(function ($messages) use ($user) {
                $otherUserId = $messages->first()->sender_id == $user->id
                    ? $messages->first()->recipient_id
                    : $messages->first()->sender_id;

                $otherUser = $messages->first()->sender_id == $user->id
                    ? $messages->first()->recipient
                    : $messages->first()->sender;

                $unreadCount = $messages->where('recipient_id', $user->id)
                    ->whereNull('read_at')
                    ->count();

                return [
                    'user' => $otherUser,
                    'last_message' => $messages->first(),
                    'unread_count' => $unreadCount
                ];
            });
    }

    /**
     * Get messages between two users.
     */
    protected function getConversationMessages($userId, $recipientId)
    {
        return Message::where(function ($query) use ($userId, $recipientId) {
            $query->where('sender_id', $userId)
                ->where('recipient_id', $recipientId);
        })
            ->orWhere(function ($query) use ($userId, $recipientId) {
                $query->where('sender_id', $recipientId)
                    ->where('recipient_id', $userId);
            })
            ->with(['sender', 'recipient'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Validate message request.
     */
    protected function validateMessageRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'recipient_id' => 'required|integer|exists:users,id',
            'message' => 'required_without_all:image,voice_note|nullable|string|max:1000',
            'image' => [
                'required_without_all:message,voice_note',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                function ($attribute, $value, $fail) {
                    if ($value && !in_array($value->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                        $fail('The ' . $attribute . ' must be a valid image file.');
                    }
                }
            ],
            'voice_note_data' => 'required_without_all:message,image|nullable|string',
        ]);
    }

    /**
     * Create a new message.
     */
    protected function createMessage(Request $request)
    {
        $messageData = [
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'message' => strip_tags($request->message),
        ];

        if ($request->hasFile('image')) {
            $messageData['image'] = $this->storeImage($request->file('image'));
        }

        if ($request->voice_note_data) {
            $messageData['voice_note'] = $this->storeVoiceNote($request->voice_note_data);
        }

        return Message::create($messageData);
    }

    /**
     * Store uploaded image.
     */
    protected function storeImage($image)
    {
        return $image->store('messages', 'public');
    }

    /**
     * Store voice note.
     */
    protected function storeVoiceNote($base64Voice)
    {
        $voiceData = base64_decode(preg_replace('#^data:audio/\w+;base64,#i', '', $base64Voice));
        $fileName = 'voice_' . auth()->id() . '_' . time() . '.wav';
        $path = 'voice_notes/' . $fileName;

        Storage::disk('public')->put($path, $voiceData);

        return $path;
    }

    /**
     * Check if user can chat with recipient.
     */
    protected function canChatWith(User $user, User $recipient)
    {
        // Add your custom logic here (e.g., check if users are friends)
        return true; // Default implementation allows all chats
    }

    /**
     * Mark messages as read.
     */
    protected function markMessagesAsRead($userId, $recipientId)
    {
        Message::where('sender_id', $recipientId)
            ->where('recipient_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
}
