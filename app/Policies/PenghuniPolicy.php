<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenghuniPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Penghuni');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:Penghuni');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Penghuni');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:Penghuni');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:Penghuni');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Penghuni');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:Penghuni');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:Penghuni');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Penghuni');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Penghuni');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:Penghuni');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Penghuni');
    }

}