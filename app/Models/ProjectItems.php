<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'city',
        'district',
        'land_area',
        'design',
        'finishing',
        'shape',
        'floors',
        'bedrooms',
        'bathrooms',
        'living_rooms',
        'kitchens',
        'annexes',
        'parking',
        'required_area',
        'terms',
        'contact',
        'estimate',
        'user_id',
        'location',
        'budget',
        'status'
    ];

    protected $casts = [
        'land_area' => 'decimal:2',
        'required_area' => 'decimal:2',
        'budget' => 'decimal:2',
        'estimate' => 'integer',
        'floors' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'living_rooms' => 'integer',
        'kitchens' => 'integer',
        'annexes' => 'integer',
        'parking' => 'integer'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function proposals()
{
    return $this->hasMany(ProjectProposal::class, 'project_id');
}

public function offers()
{
    return $this->hasMany(ProjectOffer::class, 'project_id');
}


    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'open' => 'مفتوح',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => 'غير معروف'
        };
    }

    
}
