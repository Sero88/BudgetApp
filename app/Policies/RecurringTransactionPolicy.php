<?php

namespace App\Policies;

use App\User;
use App\RecurringTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecurringTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any recurring transactions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the recurring transaction.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringTransaction  $recurringTransaction
     * @return mixed
     */
    public function view(User $user, RecurringTransaction $recurringTransaction)
    {
        //
    }

    /**
     * Determine whether the user can create recurring transactions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the recurring transaction.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringTransaction  $recurringTransaction
     * @return mixed
     */
    public function update(User $user, RecurringTransaction $recurringTransaction)
    {
        return $user->id === $recurringTransaction->owner_id;
    }

    /**
     * Determine whether the user can delete the recurring transaction.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringTransaction  $recurringTransaction
     * @return mixed
     */
    public function delete(User $user, RecurringTransaction $recurringTransaction)
    {
        //
    }

    /**
     * Determine whether the user can restore the recurring transaction.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringTransaction  $recurringTransaction
     * @return mixed
     */
    public function restore(User $user, RecurringTransaction $recurringTransaction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the recurring transaction.
     *
     * @param  \App\User  $user
     * @param  \App\RecurringTransaction  $recurringTransaction
     * @return mixed
     */
    public function forceDelete(User $user, RecurringTransaction $recurringTransaction)
    {
        //
    }
}
