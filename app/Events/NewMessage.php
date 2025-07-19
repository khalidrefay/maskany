<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('messages.' . $this->message->recipient_id);
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'message' => $this->message->message,
                'image' => $this->message->image,
                'voice_note' => $this->message->voice_note,
                'sender' => [
                    'id' => $this->message->sender->id,
                    'name' => $this->message->sender->first_name . ' ' . $this->message->sender->last_name,
                    'avatar' => $this->message->sender->image ? asset('storage/' . $this->message->sender->image) : null,
                ],
                'created_at' => $this->message->created_at->diffForHumans(),
            ]
        ];
    }
}
