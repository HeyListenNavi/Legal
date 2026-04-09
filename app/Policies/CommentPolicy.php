<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('comment.view_any');
    }

    public function view(User $user, Comment $record): bool
    {
        return $user->can('comment.view');
    }

    public function create(User $user): bool
    {
        return $user->can('comment.create');
    }

    public function update(User $user, Comment $record): bool
    {
        return $user->can('comment.update');
    }

    public function delete(User $user, Comment $record): bool
    {
        return $user->can('comment.delete');
    }
}
