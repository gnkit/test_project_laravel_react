<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Todo\DeleteTodoAction;
use App\Actions\Todo\GetAllTodoAction;
use App\Actions\Todo\UpsertTodoAction;
use App\DataTransferObjects\Todo\TodoData;
use App\Http\Controllers\Controller;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = GetAllTodoAction::execute();

        return response()->json(['data' => $todos]);
    }

    /**
     * @param TodoData $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TodoData $data)
    {

        UpsertTodoAction::execute($data);

        return response()->json('The todo created successfully.');
    }

    /**
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Todo $todo)
    {
        $todoData = TodoData::from($todo);

        return response()->json([ 'data' => $todoData ]);
    }

    /**
     * @param TodoData $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TodoData $data)
    {

        UpsertTodoAction::execute($data);

        return response()->json('The todo updated successfully.');
    }

    /**
     * @param Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Todo $todo)
    {
        DeleteTodoAction::execute($todo);

        return response()->json('The todo deleted successfully.');
    }
}
