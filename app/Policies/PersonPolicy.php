<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        if ($this->create($user)) {
            request()->request->add(['superadmin' => true]);
        }

        return $user->hasVerifiedEmail();
    }

    /**
     * Allows only super admin
     *
     * @param User|null $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return (int) optional($user)->id === 1;
    }
}
