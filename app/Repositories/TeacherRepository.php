<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository extends BaseRepository {

    public function create(array $data) {
        return Teacher::create($data);
    }

    public function update($teacher, array $data) {
        return $teacher->update($data);
    }

    public function delete($teacher) {
        return $teacher->delete($teacher);
    }
}
