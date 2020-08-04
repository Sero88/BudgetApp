<?php

namespace App\Policies;

use App\User;
use App\PaymentType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any payment types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the payment type.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function view(User $user, PaymentType $paymentType)
    {
        //
    }

    /**
     * Determine whether the user can create payment types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the payment type.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function update(User $user, PaymentType $paymentType)
    {
        return $user->id == $paymentType->owner_id;
    }

    /**
     * Determine whether the user can delete the payment type.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function delete(User $user, PaymentType $paymentType)
    {
        //
    }

    /**
     * Determine whether the user can restore the payment type.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function restore(User $user, PaymentType $paymentType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payment type.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentType  $paymentType
     * @return mixed
     */
    public function forceDelete(User $user, PaymentType $paymentType)
    {
        //
    }
}
