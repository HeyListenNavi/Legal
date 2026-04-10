<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('role.view_any');
    }

    public function view(User $user, Role $record): bool
    {
        return $user->can('role.view');
    }

    public function create(User $user): bool
    {
        return $user->can('role.create');
    }

    public function update(User $user, Role $record): bool
    {
        return $user->can('role.update');
    }

    public function delete(User $user, Role $record): bool
    {
        return $user->can('role.delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('role.delete');
    }
}
