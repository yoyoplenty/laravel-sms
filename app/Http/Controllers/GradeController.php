<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Repositories\GradeRepository;

class GradeController extends BaseController {

    protected $gradeRepository;

    public function __construct(GradeRepository $repository) {
        $this->gradeRepository = $repository;

        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allGrades = $this->gradeRepository->paginate();

        return $this->sendResponse(
            GradeResource::collection($allGrades),
            "successfully fetched grades"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request) {
        $createdGrade = $this->gradeRepository->createGrade($request->all());

        return $this->sendResponse(
            new GradeResource($createdGrade),
            "successfully created grade"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $grade = $this->gradeRepository->findById($id);

        return $this->sendResponse(new GradeResource($grade));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, $id) {
        $updatedGrade = $this->gradeRepository->update($id, $request->all());

        return $this->sendResponse(new GradeResource($updatedGrade));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->gradeRepository->delete($id);

        return $this->sendResponse(null, 'Deleted successfully');
    }
}
