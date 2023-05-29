<?php

namespace App\Actions\User;

use App\Models\User;

final class GetByEmailUserAction
{
    /**
     * @return User
     */
    public static function execute($email): User
    {
        $user = User::where('email', $email)->first();

        return $user;
    }
}
