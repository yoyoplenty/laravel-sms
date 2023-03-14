<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository {

    public function create(array $data) {
        return User::create($data);
    }

    public function update($user, array $data) {
        return $user->update($data);
    }

    public function delete($user) {
        return $user->delete($user);
    }
}
