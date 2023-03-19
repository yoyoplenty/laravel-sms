<?php

namespace App\Repositories;

use Exception;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Exceptions\ErrorResponse;

class TeacherRepository extends BaseRepository {

    protected $model;
    protected $userRepository;
    protected $gradeRepository;
    protected $subjectRepository;

    public function __construct(
        Teacher $model,
        UserRepository $userRepository,
        GradeRepository $gradeRepository,
        SubjectRepository $subjectRepository
    ) {
        parent::__construct($model, 'Teacher');

        $this->model = $model;
        $this->userRepository = $userRepository;
        $this->gradeRepository = $gradeRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function createTeacher(array $data) {
        try {
            //TODO make this a DB transaction
            ['firstname' => $firstname, 'lastname' => $lastname] = $data;
            $middlename = data_get($data, 'middlename');
            $subjectIds = data_get($data, 'subject_ids');

            $this->userRepository->getUserByNames($firstname, $lastname, $middlename);

            $subjects = $subjectIds ? array_map(function ($subjectId) {
                $subject = $this->subjectRepository->findById($subjectId);
                return $subject->id;
            }, $subjectIds) : null;

            $user = $this->userRepository->createUser($data);

            $data['staff_id'] = Str::random(5);
            $data['user_id'] = $user->id;

            $newTeacher = $this->create($data);
            $subjects ? $newTeacher->subjects()->attach($subjects) : null;

            return $newTeacher;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function findWithMissing(Int $id) {
        $teachers = $this->findById($id);

        return $teachers->loadMissing(['user', 'grade', 'subjects']);
    }
}
