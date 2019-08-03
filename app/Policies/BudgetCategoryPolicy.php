<?php

namespace App\Policies;

use App\User;
use App\BudgetCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetCategoryPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any budget categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the budget category.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetCategory  $budgetCategory
     * @return mixed
     */
    public function view(User $user, BudgetCategory $budgetCategory)
    {
        //
    }

    /**
     * Determine whether the user can create budget categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the budget category.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetCategory  $budgetCategory
     * @return mixed
     */
    public function update(User $user, BudgetCategory $budgetCategory)
    {
        return $budgetCategory->balance->owner->id == $user->id;
    }

    /**
     * Determine whether the user can delete the budget category.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetCategory  $budgetCategory
     * @return mixed
     */
    public function delete(User $user, BudgetCategory $budgetCategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the budget category.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetCategory  $budgetCategory
     * @return mixed
     */
    public function restore(User $user, BudgetCategory $budgetCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the budget category.
     *
     * @param  \App\User  $user
     * @param  \App\BudgetCategory  $budgetCategory
     * @return mixed
     */
    public function forceDelete(User $user, BudgetCategory $budgetCategory)
    {
        //
    }
}
