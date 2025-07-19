<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'budget',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stages()
    {
        return $this->hasMany(ProjectStage::class);
    }

    public function proposals()
    {
        return $this->hasMany(ProjectProposal::class);
    }

    public function items()
    {
        return $this->hasMany(\App\Models\ProjectItems::class, 'project_id');
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'معلق',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            default => 'غير معروف'
        };
    }
}
