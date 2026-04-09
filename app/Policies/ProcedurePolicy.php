<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Procedure;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProcedurePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('procedure.view_any');
    }

    public function view(User $user, Procedure $record): bool
    {
        return $user->can('procedure.view');
    }

    public function create(User $user): bool
    {
        return $user->can('procedure.create');
    }

    public function update(User $user, Procedure $record): bool
    {
        return $user->can('procedure.update');
    }

    public function delete(User $user, Procedure $record): bool
    {
        return $user->can('procedure.delete');
    }
}
