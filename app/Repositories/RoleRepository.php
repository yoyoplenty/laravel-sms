<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Role;

class RoleRepository extends BaseRepository {

    protected $model;

    public function __construct(Role $model) {
        parent::__construct($model, 'Role');

        $this->model = $model;
    }

    public function createRole(array $data) {
        $name = data_get($data, 'name');

        $this->getByName($name);

        return $this->create($data);
    }
}
