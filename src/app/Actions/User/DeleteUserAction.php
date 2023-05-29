<?php

namespace App\Actions\User;

use App\Models\User;

final class DeleteUserAction
{
    /**
     * @param User $user
     * @return void
     */
    public static function execute(User $user)
    {
        $user->delete();
    }
}
