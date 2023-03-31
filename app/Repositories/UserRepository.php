<?php

namespace App\Repositories;

use App\Events\UserCreated;
use Exception;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Exceptions\ErrorResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserRepository extends BaseRepository {

    protected $model;

    public function __construct(User $model) {
        parent::__construct($model, 'User');

        $this->model = $model;
    }

    public function createUser(array $data) {
        ['password' => $password] = $data;

        $data['uuid'] = Uuid::uuid4();
        $data['password'] = Hash::make($password);

        $createdUser = $this->create($data);
        event(new UserCreated($createdUser));

        return $createdUser;
    }

    public function getUserByEmail($email) {
        try {
            $user = $this->model::where('email', '=', $email)->first();
            if ($user) throw new ErrorResponse('user with email already exist');

            return $user;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function getUserByNames($firstname, $lastname, $middlename = null) {
        try {
            $user =   $this->model::where('firstname', $firstname)->where('lastname', $lastname)
                ->where('middlename', $middlename)->first();
            if ($user) throw new ErrorResponse('user already exist');

            return $user;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }
}
