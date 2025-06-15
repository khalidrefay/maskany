<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandExchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'current_location',
        'desired_locations',
        'current_area',
        'description',
        'image',
        'phone_number',
        'price',
        'for_sale',
        'for_exchange',
        'map_coordinates',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
