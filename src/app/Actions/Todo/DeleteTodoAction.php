<?php

namespace App\Actions\Todo;

use App\Models\Todo;

final class DeleteTodoAction
{
    /**
     * @param Todo $todo
     * @return void
     */
    public static function execute(Todo $todo)
    {
        $todo->delete();
    }
}
