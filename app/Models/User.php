<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the consultant profile associated with the user.
     */
    public function consultantProfile()
    {
        return $this->hasOne(ConsultantProfile::class);
    }
    public function deliveries()
{
    return $this->hasMany(Delivery::class, 'consultant_id');
}
public function contractorProjects()
{
    return $this->belongsToMany(Project::class, 'project_contractor')
                ->withPivot(['price', 'timeline', 'details', 'status']);
}

public function consultantProposals()
{
    return $this->hasMany(Proposal::class, 'consultant_id');
}

    /**
     * Get the contractor profile associated with the user.
     */
    public function contractorProfile()
    {
        return $this->hasOne(ContractorProfile::class);
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if the user is online (based on cache).
     */
    public function isOnline()
    {
        return cache()->has('user-is-online-' . $this->id);
    }

    public function canChatWith(User $otherUser)
    {
        // مثال: لا يمكن الدردشة مع نفسك
        if ($this->id === $otherUser->id) {
            return false;
        }
        // يمكنك إضافة شروط أخرى هنا (مثلاً: تحقق من الحظر أو الصلاحيات)
        return true;
    }
    // في app/Models/User.php
    public function contractorOffers()
    {
        return $this->hasMany(ContractorOffer::class, 'contractor_id');
    }
}
