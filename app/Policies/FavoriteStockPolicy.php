<?php

namespace App\Policies;

use App\User;
use App\FavoriteStock;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoriteStockPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, FavoriteStock $favoriteStock)
    {
        return $user->id == $favoriteStock->user_id;
    }
}
