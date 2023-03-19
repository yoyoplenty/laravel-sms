<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Models\Subject;

class SubjectRepository extends BaseRepository {

    protected $model;
    protected $gradeRepository;

    public function __construct(Subject $model, GradeRepository $gradeRepository) {
        parent::__construct($model, 'Subject');

        $this->model = $model;
        $this->gradeRepository = $gradeRepository;
    }

    public function createSubject(array $data) {
        $name = data_get($data, 'name');
        $code = data_get($data, 'code');
        $gradeIds = data_get($data, 'grade_ids');

        $subject = $this->model::where('name', '=', $name)->orWhere('code', '=', $code)->first();
        if ($subject) throw new ErrorResponse('subject already exist');

        $grades = $gradeIds ? array_map(function ($gradeId) {
            $grade = $this->gradeRepository->findById($gradeId);
            return $grade->id;
        }, $gradeIds) : null;

        $newSubject = $this->create($data);
        $grades ? $newSubject->grades()->attach($grades) : null;

        return $newSubject;
    }

    public function findWithMissing($id) {
        $subjects = $this->findById($id);

        return $subjects->loadMissing('grades');
    }
}
