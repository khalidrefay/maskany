<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'license_number',
        'address',
    ];

    /**
     * Get the user that owns the contractor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
