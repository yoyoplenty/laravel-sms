<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Exceptions\ErrorResponse;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository {

    protected $model;

    public function __construct(User $model) {
        parent::__construct($model);

        $this->model = $model;
    }

    public function createUser(array $data) {
        ['password' => $password] = $data;
        $data['password'] = Hash::make($password);

        return $this->create($data);
    }

    public function getUserByEmail($email) {
        try {
            $user = $this->model::where('email', '=', $email)->first();
            if ($user) throw new ErrorResponse('user already exist');

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
