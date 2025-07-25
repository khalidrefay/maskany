<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
public function project()
{
    return $this->belongsTo(Project::class);
}

public function proposal()
{
    return $this->belongsTo(Proposal::class);
}

public function acceptable()
{
    return $this->morphTo();
}
public function scopeForProject($query, $projectId)
{
    return $query->where('project_id', $projectId)
                ->orWhereHas('proposal', fn($q) => $q->where('project_id', $projectId));
}
}
