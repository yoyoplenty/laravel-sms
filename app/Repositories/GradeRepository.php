<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Grade;

class GradeRepository extends BaseRepository {

    protected $model;

    public function __construct(Grade $model) {
        parent::__construct($model, 'Grade');

        $this->model = $model;
    }

    public function createGrade(array $data) {
        $name = data_get($data, 'name');

        $grade = $this->model::where('name', '=', $name)->first();
        if ($grade) throw new ErrorResponse('grade with name already exist');

        return $this->create($data);
    }
}
