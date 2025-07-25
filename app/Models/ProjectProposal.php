<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'consultant_id', 'contractor_id', 'design_plans', 'materials_list', 'price', 'duration', 'notes', 'status', 'rating', 'final_delivery_files'];

    protected $casts = [
        'design_plans' => 'array',
        'final_delivery_files' => 'array',
        'price' => 'decimal:2',
        'duration' => 'integer',
        'rating' => 'decimal:2'
    ];

    public function project()
    {
        return $this->belongsTo(ProjectItems::class, 'project_id');
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }



    public function markAsAccepted()
    {
        $this->update(['status' => 'accepted']);
        if ($this->project) {
            $this->project->update(['status' => 'consultant_accepted']);
        }
    }
    public function contractor_offers()
    {
        return $this->hasMany(ContractorOffer::class, 'proposal_id');
    }

    public function getStatusTextAttribute()
    {
        return [
            'pending' => 'قيد المراجعة',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            'delivered' => 'تم التسليم'
        ][$this->status] ?? $this->status;
    }

    // الحصول على لون البادج حسب الحالة
    public function getStatusBadgeAttribute()
    {
        return [
            'pending' => 'warning',
            'accepted' => 'success',
            'rejected' => 'danger',
            'delivered' => 'info'
        ][$this->status] ?? 'secondary';
    }

    
}