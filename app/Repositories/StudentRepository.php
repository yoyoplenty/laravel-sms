<?php

namespace App\Repositories;

use Exception;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Exceptions\ErrorResponse;
use App\Repositories\GradeRepository;

class StudentRepository extends BaseRepository {

    protected $model;
    protected $userRepository;
    protected $gradeRepository;

    public function __construct(Student $model, UserRepository $userRepository, GradeRepository $gradeRepository) {
        parent::__construct($model, 'Student');

        $this->model = $model;
        $this->userRepository = $userRepository;
        $this->gradeRepository = $gradeRepository;
    }

    public function createStudent(array $data) {
        try {
            ['firstname' => $firstname, 'lastname' => $lastname] = $data;
            $middlename = data_get($data, 'middlename');

            $this->userRepository->getUserByNames($firstname, $lastname, $middlename);

            $user = $this->userRepository->createUser($data);

            $data['student_id'] = Str::random(5);
            $data['admission_date'] = date('Y-m-d H:i:s');
            $data['user_id'] = $user->id;

            return $this->create($data);
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function findWithMissing($id) {
        try {
            $students = $this->findById($id);

            return $students->loadMissing(['user', 'grade']);
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }
}
