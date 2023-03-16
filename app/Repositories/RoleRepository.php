<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Role;

class RoleRepository extends BaseRepository {

    protected $model;

    public function __construct(Role $model) {
        parent::__construct($model);

        $this->model = $model;
    }

    public function createRole(array $data) {
        $name = data_get($data, 'name');

        $role = $this->model::where('name', '=', $name)->first();
        if ($role) throw new ErrorResponse('role with name already exist');

        return $this->create($data);
    }
}
