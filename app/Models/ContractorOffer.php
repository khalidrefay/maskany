<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorOffer extends Model
{
    protected $fillable = ['project_id', 'contractor_id', 'price', 'timeline', 'details', 'pdf_file', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }
    public function proposal()
{
    return $this->belongsTo(Proposal::class, 'proposal_id');
}

}