<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Subject;
use Exception;

class SubjectRepository extends BaseRepository {

    protected $model;
    protected $gradeRepository;

    public function __construct(Subject $model, GradeRepository $gradeRepository) {
        parent::__construct($model);

        $this->model = $model;
        $this->gradeRepository = $gradeRepository;
    }

    public function createSubject(array $data) {

        $gradeIds = data_get($data, 'grade_ids');
        $grades = $this->gradeRepository->find($gradeIds);

        $newSubject = $this->create($data)->grades()->attach($grades);

        return $newSubject;
    }

    public function findWithMissing($id) {
        $subjects = $this->findById($id);

        if (!$subjects) throw new ErrorResponse('unable to find subjects');
        return $subjects->loadMissing('grades');
    }
}
