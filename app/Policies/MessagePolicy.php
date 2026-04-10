<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('message.view_any');
    }

    public function view(User $user, Message $record): bool
    {
        return $user->can('message.view');
    }

    public function create(User $user): bool
    {
        return $user->can('message.create');
    }

    public function update(User $user, Message $record): bool
    {
        return $user->can('message.update');
    }

    public function delete(User $user, Message $record): bool
    {
        return $user->can('message.delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('message.delete');
    }

}
