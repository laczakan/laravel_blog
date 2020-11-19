<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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

    public function before($user, $ability)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function add(?User $user)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function update(?User $user)
    {
        if ($user->admin) {
            return true;
        }
    }
}
