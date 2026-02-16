<?php

namespace App\Policies;

use App\Models\Employment;
use App\Models\User;

class EmploymentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Employment $employment)
    {
        return $user->id === $employment->created_by_id;
    }
}
