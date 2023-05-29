<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class GetAllUserAction
{
    /**
     * @return Collection
     */
    public static function execute(): Collection
    {
        $users = User::select(['id', 'name', 'email'])->get();

        return $users;
    }
}
