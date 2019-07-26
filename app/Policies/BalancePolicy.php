<?php

namespace App\Policies;

use App\User;
use App\Balance;
use Illuminate\Auth\Access\HandlesAuthorization;

class BalancePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any balances.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the balance.
     *
     * @param  \App\User  $user
     * @param  \App\Balance  $balance
     * @return mixed
     */
    public function view(User $user, Balance $balance)
    {
        //
    }

    /**
     * Determine whether the user can create balances.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the balance.
     *
     * @param  \App\User  $user
     * @param  \App\Balance  $balance
     * @return mixed
     */
    public function update(User $user, Balance $balance)
    {
        return $user->id == $balance->owner_id;
    }

    /**
     * Determine whether the user can delete the balance.
     *
     * @param  \App\User  $user
     * @param  \App\Balance  $balance
     * @return mixed
     */
    public function delete(User $user, Balance $balance)
    {
        //
    }

    /**
     * Determine whether the user can restore the balance.
     *
     * @param  \App\User  $user
     * @param  \App\Balance  $balance
     * @return mixed
     */
    public function restore(User $user, Balance $balance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the balance.
     *
     * @param  \App\User  $user
     * @param  \App\Balance  $balance
     * @return mixed
     */
    public function forceDelete(User $user, Balance $balance)
    {
        //
    }
}
