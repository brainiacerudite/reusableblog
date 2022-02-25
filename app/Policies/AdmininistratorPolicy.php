<?php

namespace App\Policies;

use App\Models\User as Administrator;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmininistratorPolicy
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

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->can('browse administrators')) {
            return true;
        }
    }

    public function viewAnyUser(User $user)
    {
        if ($user->can('browse users')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User as Administrator  $administrator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        if ($user->can('read administrators')) {
            return true;
        }
    }

    public function viewUser(User $user)
    {
        if ($user->can('read users')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('add administrators')) {
            return true;
        }
    }

    public function createUser(User $user)
    {
        if ($user->can('add users')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User as Administrator  $administrator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        if ($user->can('edit administrators')) {
            return true;
        }
    }

    public function updateUser(User $user)
    {
        if ($user->can('edit users')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User as Administrator  $administrator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        if ($user->can('delete administrators')) {
            return true;
        }
    }

    public function deleteUser(User $user)
    {
        if ($user->can('delete users')) {
            return true;
        }
    }

}
