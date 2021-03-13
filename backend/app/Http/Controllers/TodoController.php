<?php

namespace App\Http\Controllers;



use App\Http\Requests\TodoStoreRequest;
use App\Http\Resources\TodoResource;

/**
 * Class MeController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();
        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }


}
