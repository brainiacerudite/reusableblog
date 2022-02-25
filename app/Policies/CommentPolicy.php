<?php

namespace App\Policies;

use App\Models\User;
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

    public function viewAny(User $user)
    {
        if ($user->can('browse comments')) {
            return true;
        }
    }

    public function view(User $user)
    {
        if ($user->can('read comments')) {
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->can('add comments')) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->can('edit comments')) {
            return true;
        }
    }

    public function delete(User $user)
    {
        if ($user->can('delete comments')) {
            return true;
        }
    }
}
