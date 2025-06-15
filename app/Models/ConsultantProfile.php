<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'experience',
        'qualifications',
    ];

    /**
     * Get the user that owns the consultant profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
