<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allUsers = Student::query()->get();

        return new JsonResponse([
            'message' => "successfully fetched all sgrades",
            "status" => 200,
            "data" => $allUsers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request, StudentRepository $studentRepository) {
        $createdStudent = $studentRepository->create($request->all());

        return new StudentResource($createdStudent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student) {
        $studentDetails = $student->loadMissing(['users', 'grades']);

        return new StudentResource($studentDetails);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student, StudentRepository $studentRepository) {
        $updatedStudent = $studentRepository->update($student, $request->all());

        return new StudentResource($updatedStudent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, StudentRepository $studentRepository) {
        $deletedStudent = $studentRepository->delete($student);

        return new StudentResource($deletedStudent);
    }
}
