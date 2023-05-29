<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

final class GetAllTodoAction
{
    /**
     * @return Collection
     */
    public static function execute(): Collection
    {
        $notes = Todo::select(['id', 'title', 'description'])->latest()->get();

        return $notes;
    }
}
