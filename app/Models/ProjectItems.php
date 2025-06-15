<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'district',
        'land_area',
        'design',
        'finishing',
        'shape',
        'floors',
        'bedrooms',
        'living_rooms',
        'bathrooms',
        'kitchens',
        'annexes',
        'parking',
        'required_area',
        'terms',
        'contact',
        'estimate',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
