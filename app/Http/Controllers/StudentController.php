<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Repositories\StudentRepository;

class StudentController extends BaseController {

    protected $studentRepository;

    public function __construct(studentRepository $repository) {
        $this->studentRepository = $repository;

        $this->middleware('auth', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allStudents = $this->studentRepository->paginate();

        return $this->sendResponse(
            StudentResource::collection($allStudents),
            "successfully fetched students"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) {
        $createdStudent =  $this->studentRepository->createStudent($request->all());

        return $this->sendResponse(
            new StudentResource($createdStudent),
            "successfully created student"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $studentDetails =  $this->studentRepository->findWithMissing($id);

        return $this->sendResponse(new StudentResource($studentDetails));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id) {
        $updatedStudent = $this->studentRepository->update($id, $request->all());

        return $this->sendResponse(new StudentResource($updatedStudent));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->studentRepository->delete($id);

        return $this->sendResponse(null, 'Deleted successfully');
    }
}
