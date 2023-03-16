<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Subject;

class SubjectRepository extends BaseRepository {

    protected $model;
    protected $gradeRepository;

    public function __construct(Subject $model, GradeRepository $gradeRepository) {
        parent::__construct($model);

        $this->model = $model;
        $this->gradeRepository = $gradeRepository;
    }

    public function createSubject(array $data) {
        $name = data_get($data, 'name');
        $code = data_get($data, 'code');
        $gradeIds = data_get($data, 'grade_ids');

        $subject = $this->model::where('name', '=', $name)->orWhere('code', '=', $code)->first();
        if ($subject) throw new ErrorResponse('grade with name already exist');

        $grades = !empty($gradeIds) ?? $this->gradeRepository->find($gradeIds);

        $newSubject = $this->create($data);
        $grades ?? $newSubject->grades()->attach($grades);

        return $newSubject;
    }

    public function findWithMissing($id) {
        $subjects = $this->findById($id);

        return $subjects->loadMissing('grades');
    }
}
