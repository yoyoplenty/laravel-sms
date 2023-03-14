<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepository {

    public function create(array $data) {
        return Student::create($data);
    }

    public function update($student, array $data) {
        return $student->update($data);
    }

    public function delete($student) {
        return $student->delete($student);
    }
}
