<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InternalAnnouncement;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalAnnouncementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('internal_announcement.view_any');
    }

    public function view(User $user, InternalAnnouncement $record): bool
    {
        return $user->can('internal_announcement.view');
    }

    public function create(User $user): bool
    {
        return $user->can('internal_announcement.create');
    }

    public function update(User $user, InternalAnnouncement $record): bool
    {
        return $user->can('internal_announcement.update');
    }

    public function delete(User $user, InternalAnnouncement $record): bool
    {
        return $user->can('internal_announcement.delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('internal_announcement.delete');
    }
}
