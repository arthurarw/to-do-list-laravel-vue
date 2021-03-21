<?php

namespace App\Http\Controllers;


use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoTaskStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use App\Models\Todo;

/**
 * Class MeController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    /**
     * @param Todo $todo
     * @return TodoResource
     */
    public function show(Todo $todo)
    {
        $todo->load('tasks');
        return new TodoResource($todo);
    }

    /**
     * @param TodoStoreRequest $request
     * @return TodoResource
     */
    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();
        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }

    /**
     * @param Todo $todo
     * @param TodoUpdateRequest $request
     * @return TodoResource
     */
    public function update(Todo $todo, TodoUpdateRequest $request)
    {
        $input = $request->validated();

        $todo->fill($input);
        $todo->save();

        return new TodoResource($todo->fresh());
    }

    /**
     * @param Todo $todo
     * @throws \Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    /**
     * @param Todo $todo
     * @param TodoTaskStoreRequest $request
     * @return TodoTaskResource
     */
    public function addTask(Todo $todo, TodoTaskStoreRequest $request)
    {
        $input = $request->validated();
        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);
    }


}
