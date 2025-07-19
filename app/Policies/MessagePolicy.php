<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Message $message)
    {
        return $user->id === $message->receiver_id || $user->id === $message->sender_id;
    }

    public function delete(User $user, Message $message)
    {
        return $user->id === $message->receiver_id;
    }
}
