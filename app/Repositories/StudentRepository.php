<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Student;

class StudentRepository extends BaseRepository {

    protected $model;

    public function __construct(Student $model) {
        parent::__construct($model);

        $this->model = $model;
    }

    public function createStudent(array $data) {
        $name = data_get($data, 'name');

        $grade = $this->model::where('name', '=', $name)->first();
        if ($grade) throw new ErrorResponse('grade with name already exist');

        return $this->create($data);
    }

    public function findWithMissing($id) {
        $students = $this->findById($id);

        return $students->loadMissing(['users', 'grades']);
    }
}
