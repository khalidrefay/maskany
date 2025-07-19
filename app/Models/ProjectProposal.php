<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'consultant_id',
        'design_plans',
        'materials_list',
        'price',
        'duration',
        'notes',
        'status',
        'rating'
    ];

    protected $casts = [
        'design_plans' => 'array',
        'price' => 'decimal:2',
        'duration' => 'integer',
        'rating' => 'decimal:2'
    ];

    public function project()
    {
        return $this->belongsTo(ProjectItems::class, 'project_id');
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
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

    public function proposals()
    {
        return $this->hasMany(ProjectProposal::class);
    }
}
