<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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

    /**
     * Determine if the given article can be added by the user.
     *
     * @param  User|null  $user
     * @return bool
     */
    public function add(?User $user)
    {
        return optional($user)->id;
    }

    /**
     * Determine if the given article can be updated by the user.
     *
     * @param  User|null  $user
     * @param  Article  $article
     * @return bool
     */
    public function update(?User $user, Article $article)
    {
        return optional($user)->id === $article->user_id || optional($user)->moderator;
    }

    /**
     * Determine if the given article can be deleted by the user.
     *
     * @param  User|null  $user
     * @param  Article  $article
     * @return bool
     */
    public function delete(?User $user, Article $article)
    {
        return optional($user)->id === $article->user_id;
    }
}
