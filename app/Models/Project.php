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
    public function deliveries()
{
    return $this->hasMany(Delivery::class);
}

    public function stages()
    {
        return $this->hasMany(ProjectStage::class);
    }

    public function proposals()
    {
        return $this->hasMany(\App\Models\ProjectProposal::class);
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
    public function acceptedProposal()
{
    return $this->hasOne(ProjectProposal::class)->where('status', 'accepted');
}


public function contractors()
{
    return $this->belongsToMany(User::class, 'project_contractor')
                ->withPivot(['price', 'timeline', 'details', 'status'])
                ->withTimestamps();
}
public function contractorOffers()
    {
        return $this->hasMany(ContractorOffer::class, 'project_id')
                    ->whereNotNull('contractor_id')
                    ->with('contractor');
    }

    // في app/Models/Project.php
public function offers()
{
    return $this->hasMany(ContractorOffer::class);
}



}
