<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function login(?User $user): bool
    {
        return empty($user);
    }
    
    public function viewAccount(?User $user): bool
    {
        return !empty($user);
    }
}
