<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',

        'message',
        'image',
        'voice_note',
        'read_at',
    ];

    public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

public function recipient()
{
    return $this->belongsTo(User::class, 'recipient_id');
}

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
