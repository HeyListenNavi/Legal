<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientCasePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('client_case.view_any');
    }

    public function view(User $user, ClientCase $record): bool
    {
        return $user->can('client_case.view');
    }

    public function create(User $user): bool
    {
        return $user->can('client_case.create');
    }

    public function update(User $user, ClientCase $record): bool
    {
        return $user->can('client_case.update');
    }

    public function delete(User $user, ClientCase $record): bool
    {
        return $user->can('client_case.delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('client_case.delete');
    }
}
