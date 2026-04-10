<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointments;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('appointment.view_any');
    }

    public function view(User $user, Appointments $record): bool
    {
        return $user->can('appointment.view');
    }

    public function create(User $user): bool
    {
        return $user->can('appointment.create');
    }

    public function update(User $user, Appointments $record): bool
    {
        return $user->can('appointment.update');
    }

    public function delete(User $user, Appointments $record): bool
    {
        return $user->can('appointment.delete');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('appointment.delete');
    }
}
