<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOffer extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function project()
{
    return $this->belongsTo(ProjectItems::class, 'project_id');
}
}
