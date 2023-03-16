<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller {

    protected $studentRepository;

    public function __construct(studentRepository $repository) {
        $this->studentRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allUsers = $this->studentRepository->paginate();;

        return new JsonResponse([
            'message' => "successfully fetched all sgrades",
            "status" => 200,
            "data" => $allUsers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) {
        $createdStudent =  $this->studentRepository->createStudent($request->all());

        return new StudentResource($createdStudent);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $studentDetails =  $this->studentRepository->findWithMissing($id);

        return new StudentResource($studentDetails);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id) {
        $updatedStudent = $this->studentRepository->update($id, $request->all());

        return new StudentResource($updatedStudent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->studentRepository->delete($id);

        return new StudentResource(null);
    }
}
