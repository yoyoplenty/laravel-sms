<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository extends BaseRepository {

    public function create(array $data) {
        return Subject::create($data);
    }

    public function update($subject, array $data) {
        return $subject->update($data);
    }

    public function delete($subject) {
        return $subject->delete($subject);
    }
}
