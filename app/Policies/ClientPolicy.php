<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('client.view_any');
    }

    public function view(User $user, Client $record): bool
    {
        return $user->can('client.view');
    }

    public function create(User $user): bool
    {
        return $user->can('client.create');
    }

    public function update(User $user, Client $record): bool
    {
        return $user->can('client.update');
    }

    public function delete(User $user, Client $record): bool
    {
        return $user->can('client.delete');
    }
}
