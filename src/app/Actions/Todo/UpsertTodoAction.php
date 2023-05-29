<?php

namespace App\Actions\Todo;

use App\DataTransferObjects\Todo\TodoData;
use App\Models\Todo;

final class UpsertTodoAction
{
    /**
     * @param TodoData $data
     * @return Todo
     */
    public static function execute(TodoData $data): Todo
    {
        $todo = Todo::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                'title' => $data->title,
                'description' => $data->description ?? '',
            ],
        );

        return $todo;
    }
}
