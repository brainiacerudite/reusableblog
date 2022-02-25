<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function view(User $user)
    {
        if ($user->can('read settings')) {
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->can('edit settings')) {
            return true;
        }
    }
}
