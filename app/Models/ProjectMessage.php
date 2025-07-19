<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'consultant_id',
        'message',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function attachments()
    {
        return $this->hasMany(ProjectMessageAttachment::class);
    }
}
