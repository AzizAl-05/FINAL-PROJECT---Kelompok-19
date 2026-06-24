<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TransaksiSewa;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiSewaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TransaksiSewa');
    }

    public function view(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('View:TransaksiSewa');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TransaksiSewa');
    }

    public function update(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('Update:TransaksiSewa');
    }

    public function delete(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('Delete:TransaksiSewa');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TransaksiSewa');
    }

    public function restore(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('Restore:TransaksiSewa');
    }

    public function forceDelete(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('ForceDelete:TransaksiSewa');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TransaksiSewa');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TransaksiSewa');
    }

    public function replicate(AuthUser $authUser, TransaksiSewa $transaksiSewa): bool
    {
        return $authUser->can('Replicate:TransaksiSewa');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TransaksiSewa');
    }

}