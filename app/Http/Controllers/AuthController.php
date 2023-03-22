<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
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

    public function confirmEmail(String $token) {
        $this->authRepository->confirmEmail($token);

        return $this->sendResponse(new UserResource(null), 'email confirmation successful');
    }

    public function resendEmail(String $email) {
        $this->authRepository->resendVerificationEmail($email);

        return $this->sendResponse(new UserResource(null), 'email sent successfully');
    }

    public function forgotPassword(ForgotPasswordRequest $request) {
        $this->authRepository->forgotPassword($request->email);

        return $this->sendResponse(
            new UserResource(null),
            'check yout mail for password reset link'
        );
    }

    public function resetPassword(String $token, ResetPasswordRequest $request) {
        $this->authRepository->resetPassword($token, $request->password);

        return $this->sendResponse(
            new UserResource(null),
            'password reset successful'
        );
    }

    public function logout(Request $request) {
        $details = $this->authRepository->logOut($request);

        return $this->sendResponse(new UserResource($details), 'successfully logged out user');
    }
}
