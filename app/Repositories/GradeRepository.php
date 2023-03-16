<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository extends BaseRepository {

    protected $model;

    public function __construct(Grade $model) {
        parent::__construct($model);

        $this->model = $model;
    }

    public function getAll() {
        return $this->model->all();
    }
}
