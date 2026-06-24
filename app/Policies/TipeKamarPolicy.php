<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TipeKamar;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipeKamarPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TipeKamar');
    }

    public function view(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('View:TipeKamar');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TipeKamar');
    }

    public function update(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('Update:TipeKamar');
    }

    public function delete(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('Delete:TipeKamar');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TipeKamar');
    }

    public function restore(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('Restore:TipeKamar');
    }

    public function forceDelete(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('ForceDelete:TipeKamar');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TipeKamar');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TipeKamar');
    }

    public function replicate(AuthUser $authUser, TipeKamar $tipeKamar): bool
    {
        return $authUser->can('Replicate:TipeKamar');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TipeKamar');
    }

}