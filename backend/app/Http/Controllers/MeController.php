<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class MeController
 * @package App\Http\Controllers
 */
class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return UserResource
     */
    public function index(): UserResource
    {
        return new UserResource(auth()->user());
    }

    public function update(MeUpdateRequest $request)
    {
        $input = $request->validated();
        $user = (new UserService())->update(auth()->user(), $input);

        return new UserResource($user);
    }
}
