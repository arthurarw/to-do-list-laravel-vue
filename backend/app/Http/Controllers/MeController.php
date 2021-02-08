<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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
}
