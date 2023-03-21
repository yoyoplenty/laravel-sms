<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthRepository {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    //TODO make an enum of userType
    public function signUp(array $data) {
        try {
            return $this->userRepository->createUser($data);
        } catch (Exception $ex) {
            throw new ErrorResponse('unable to register user');
        }
    }

    public function signIn(array $data) {
        try {
            ['email' => $email, 'password' => $password, 'role_id' => $roleId] = $data;

            $user = $this->userRepository->findByField('email', $email);
            if ($user->role_id !== $roleId) throw new ErrorResponse('user role does not match');

            if (!Hash::check($password, $user->password)) throw new ErrorResponse('invalid credentials');

            return [
                "user" =>  $user,
                "token" => $user->createToken('smsApiToken')->plainTextToken
            ];
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function logOut(Request $request) {
        try {
            return $request->user()->tokens()->delete();
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }
}
