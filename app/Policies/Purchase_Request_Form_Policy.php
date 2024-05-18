<?php

namespace App\Policies;

use App\Models\Purchase_Request_Form;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Purchase_Request_Form_Policy
{
    # ADD THIS CODE TO ALL RESOURCES
    public function deleteAny(User $user): bool #FOR bulk deletion
    {
        return $user->isAdmin();
    }

    public function forceDeleteAny(User $user): bool  #FOR bulk forcedeletion
    {
        return $user->isAdmin();
    }

    public function restoreAny(User $user): bool #FOR bulk restoration
    { 
        return $user->isAdmin();
    }
    # ADD THIS CODE TO ALL RESOURCES

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Purchase_Request_Form $purchaseRequestForm): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Purchase_Request_Form $purchaseRequestForm): bool
    {
        //
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Purchase_Request_Form $purchaseRequestForm): bool
    {
        //
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Purchase_Request_Form $purchaseRequestForm): bool
    {
        //
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Purchase_Request_Form $purchaseRequestForm): bool
    {
        //
        return $user->isAdmin();
    }
}
