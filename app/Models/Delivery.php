<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
    'project_id',
    'consultant_id',
    'files',
    'notes'
];

public function project()
{
    return $this->belongsTo(Project::class);
}

public function consultant()
{
    return $this->belongsTo(User::class, 'consultant_id');
}
}
