<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateteacherRequest;
use App\Http\Resources\TeacherResource;
use App\Repositories\TeacherRepository;

class TeacherController extends BaseController {

    protected $teacherRepository;

    public function __construct(TeacherRepository $repository) {
        $this->teacherRepository = $repository;

        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allteachers = $this->teacherRepository->paginate();

        return $this->sendResponse(
            TeacherResource::collection($allteachers),
            "successfully fetched teacherss"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreteacherRequest $request) {
        $createdteacher =  $this->teacherRepository->createTeacher($request->all());

        return $this->sendResponse(
            new TeacherResource($createdteacher),
            "successfully created teacher"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $teacherDetails =  $this->teacherRepository->findWithMissing($id);

        return $this->sendResponse(new TeacherResource($teacherDetails));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateteacherRequest $request, $id) {
        $updatedteacher = $this->teacherRepository->update($id, $request->all());

        return $this->sendResponse(new TeacherResource($updatedteacher));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->teacherRepository->delete($id);

        return $this->sendResponse(null, 'Deleted successfully');
    }
}
