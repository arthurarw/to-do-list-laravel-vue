<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoTaskUpdateRequest;
use App\Http\Resources\TodoTaskResource;
use App\Models\TodoTask;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class TodoTaskController
 * @package App\Http\Controllers
 */
class TodoTaskController extends Controller
{
    /**
     * TodoTaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @param TodoTask $todoTask
     * @param TodoTaskUpdateRequest $request
     * @return TodoTaskResource
     * @throws AuthorizationException
     */
    public function update(TodoTask $todoTask, TodoTaskUpdateRequest $request): TodoTaskResource
    {
        $this->authorize('update', $todoTask);
        $input = $request->validated();

        $todoTask->fill($input);
        $todoTask->save();

        return new TodoTaskResource($todoTask);
    }

    /**
     * @param TodoTask $todoTask
     * @throws AuthorizationException
     */
    public function destroy(TodoTask $todoTask)
    {
        $this->authorize('destroy', $todoTask);
        $todoTask->delete();
    }
}
