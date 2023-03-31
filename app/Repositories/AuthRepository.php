<?php

namespace App\Repositories;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Events\UserResetPassword;
use App\Exceptions\ErrorResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Events\PasswordResetSuccessful;

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
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function signIn(array $data) {
        try {
            ['email' => $email, 'password' => $password, 'role_id' => $roleId] = $data;

            $user = $this->userRepository->findByField('email', $email);
            if ($user->role_id !== $roleId) throw new ErrorResponse('user role does not match');
            if ($user->is_active === 0) throw new ErrorResponse('user is not verified, please check your mail');

            if (!Hash::check($password, $user->password)) throw new ErrorResponse('invalid credentials');

            return [
                "user" =>  $user,
                "token" => $user->createToken('smsApiToken')->plainTextToken
            ];
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function confirmEmail(String $token) {
        try {
            $decryptedToken = Crypt::decryptString($token);
            if (!($decryptedToken || Uuid::isValid($decryptedToken))) throw new ErrorResponse('invalid token provided');

            $user = $this->userRepository->findByField('uuid', $decryptedToken);
            if (!$user) throw new ErrorResponse('user not found');

            if ($user->is_active === 1) throw new ErrorResponse('user already verified');

            $user->update(['is_active' => 1]);

            return $user;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function resendVerificationEmail(String $email) {
        try {
            $user = $this->userRepository->findByField('email', $email);

            if ($user->is_active === 1) throw new ErrorResponse('user already verified');
            $user->update(['uuid' => Uuid::uuid4()]);

            event(new UserCreated($user));

            return $user;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }


    public function forgotPassword(String $email) {
        try {
            $user = $this->userRepository->findByField('email', $email);
            $user->update(['reset_token' => Uuid::uuid4()]);

            event(new UserResetPassword($user));

            return $user;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }


    public function resetPassword(String $token, String $password) {
        try {
            $decryptedToken = Crypt::decryptString($token);
            if (!($decryptedToken || Uuid::isValid($decryptedToken))) throw new ErrorResponse('invalid token provided');

            $user = $this->userRepository->findByField('reset_token', $decryptedToken);

            $hashedPassword = Hash::make($password);
            $user->update(['password' => $hashedPassword]);

            event(new PasswordResetSuccessful($user));

            return $user;
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
