<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('payment.view_any');
    }

    public function view(User $user, Payment $record): bool
    {
        return $user->can('payment.view');
    }

    public function create(User $user): bool
    {
        return $user->can('payment.create');
    }

    public function update(User $user, Payment $record): bool
    {
        return $user->can('payment.update');
    }

    public function delete(User $user, Payment $record): bool
    {
        return $user->can('payment.delete');
    }
}
