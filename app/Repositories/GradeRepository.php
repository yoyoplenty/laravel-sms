<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository extends BaseRepository {

    public function create(array $data) {
        return Grade::create($data);
    }

    public function update($grade, array $data) {
        return $grade->update($data);
    }

    public function delete($grade) {
        return $grade->delete($grade);
    }
}
