<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('document.view_any');
    }

    public function view(User $user, Document $record): bool
    {
        return $user->can('document.view');
    }

    public function create(User $user): bool
    {
        return $user->can('document.create');
    }

    public function update(User $user, Document $record): bool
    {
        return $user->can('document.update');
    }

    public function delete(User $user, Document $record): bool
    {
        return $user->can('document.delete');
    }
}
