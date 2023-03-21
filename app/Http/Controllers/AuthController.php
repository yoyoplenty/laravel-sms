<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends BaseController {

    protected $authRepository;

    public function __construct(AuthRepository $repository) {
        $this->authRepository = $repository;

        // $this->middleware('auth:sanctum');
    }

    public function register(RegisterRequest $request) {
        $registeredUser = $this->authRepository->signUp($request->all());

        return $this->sendResponse(new UserResource($registeredUser), 'successfully registered user');
    }

    public function signin(LoginRequest $request) {
        $details = $this->authRepository->signIn($request->all());

        return $this->sendResponse(new UserResource($details), 'successfully logged in user');
    }

    public function confirmEmail() {
        return [];
    }

    public function resendEmail() {
        return [];
    }

    public function forgotPassword() {
        return [];
    }

    public function resetPassword() {
        return [];
    }

    public function logout(Request $request) {
        $details = $this->authRepository->logOut($request);

        return $this->sendResponse(new UserResource($details), 'successfully logged out user');
    }
}
