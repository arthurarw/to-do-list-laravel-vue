<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthForgotPasswordRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthResetPasswordRequest;
use App\Http\Requests\AuthVerifyEmailRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param AuthLoginRequest $request
     * @return UserResource
     * @throws \App\Exceptions\LoginInvalidException
     */
    public function login(AuthLoginRequest $request): UserResource
    {
        $input = $request->validated();
        $token = $this->authService->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional($token);
    }

    /**
     * @param AuthRegisterRequest $request
     * @return UserResource
     * @throws \App\Exceptions\UserHasBeenTakenException
     */
    public function register(AuthRegisterRequest $request): UserResource
    {
        $input = $request->validated();
        $user = $this->authService->register($input);

        return new UserResource($user);
    }

    /**
     * @param AuthVerifyEmailRequest $request
     * @return UserResource
     * @throws \App\Exceptions\VerifyEmailTokenInvalidException
     */
    public function verifyEmail(AuthVerifyEmailRequest $request): UserResource
    {
        $input = $request->validated();
        $user = $this->authService->verifyEmail($input['token']);

        return new UserResource($user);
    }

    /**
     * @param AuthForgotPasswordRequest $request
     * @return mixed
     */
    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $input = $request->validated();

        return $this->authService->forgotPassword($input['email']);
    }

    /**
     * @param AuthResetPasswordRequest $request
     * @return string
     * @throws \App\Exceptions\ResetPasswordTokenInvalidException
     */
    public function resetPassword(AuthResetPasswordRequest $request): string
    {
        $input = $request->validated();
        return $this->authService->resetPassword($input['email'], $input['password'], $input['token']);
    }
}
