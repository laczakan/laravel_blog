<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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
     * Determine if the given comment can be updated by the user.
     *
     * @param  User|null  $user
     * @param  Comment  $comment
     * @return bool
     */
    public function update(?User $user, Comment $comment)
    {
        return optional($user)->id === $comment->user_id || optional($user)->moderator;
    }

    /**
     * Determine if the given comment can be deleted by the user.
     *
     * @param  User|null  $user
     * @param  Comment  $comment
     * @return bool
     */
    public function delete(?User $user, Comment $comment)
    {
        return optional($user)->id === $comment->user_id;
    }
}
