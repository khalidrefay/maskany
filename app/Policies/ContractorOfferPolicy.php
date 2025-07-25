<?php

namespace App\Policies;

use App\Models\ContractorOffer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContractorOfferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }
    public function create(User $user, Project $project)
{
    // فقط المقاولون يمكنهم تقديم عروض
    return $user->role === 'contractor' && 
           $project->proposals()->where('status', 'accepted')->exists();
}

public function store(User $user, Project $project)
{
    return $this->create($user, $project);
}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContractorOffer $contractorOffer): bool
    {
        //
    }


   
    public function update(User $user, ContractorOffer $contractorOffer): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContractorOffer $contractorOffer): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContractorOffer $contractorOffer): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContractorOffer $contractorOffer): bool
    {
        //
    }
}
