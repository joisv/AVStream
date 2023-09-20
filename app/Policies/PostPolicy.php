<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('can create')
            ? Response::allow()
            : Response::deny('You do not have right permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, Post $post): Response
    {
        if ($user->hasRole('admin')) {
            return Response::allow();
        } else {
            if ($user->hasAllPermissions('can update') && $user->id == $post->user_id) {
                return Response::allow();
            } else {
                return Response::deny('You do not own this post.');
            }
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        if (
            ($user->hasRole('writer') && $user->id === $post->user_id) ||
            ($user->hasPermissionTo('can delete'))
        ) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete this post.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
