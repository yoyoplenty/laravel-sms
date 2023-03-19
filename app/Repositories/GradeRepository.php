<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository extends BaseRepository {

    protected $model;

    public function __construct(Grade $model) {
        parent::__construct($model, 'Grade');

        $this->model = $model;
    }

    public function createGrade(array $data) {
        $name = data_get($data, 'name');

        $this->getByName($name);

        return $this->create($data);
    }
}
