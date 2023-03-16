<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository extends BaseRepository {

    protected $model;

    public function __construct(Teacher $model) {
        parent::__construct($model);

        $this->model = $model;
    }
}
