<?php

namespace App\Actions\User;

use App\DataTransferObjects\User\UserData;
use App\Models\User;

final class UpsertUserAction
{
    /**
     * @param UserData $data
     * @return User
     */
    public static function execute(UserData $data): User
    {
        $user = User::updateOrCreate(
            [
                'id' => $data->id
            ],
            [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'remember_token' => $data->remember_token,
            ],
        );

        return $user;
    }
}
