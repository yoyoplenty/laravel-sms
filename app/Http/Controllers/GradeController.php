<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Repositories\GradeRepository;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller {

    protected $gradeRepository;

    public function __construct(GradeRepository $repository) {
        $this->gradeRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allGrades = $this->gradeRepository->getAll();

        return new JsonResponse([
            'message' => "successfully fetched all sgrades",
            "status" => 200,
            "data" => $allGrades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request) {
        $createdGrade = $this->gradeRepository->create($request->all());

        return new GradeResource($createdGrade);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $grade = $this->gradeRepository->findById($id);

        return new GradeResource($grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, $id) {
        $updatedGrade = $this->gradeRepository->update($id, $request->all());

        return new GradeResource($updatedGrade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $deletedGrade =  $this->gradeRepository->delete($id);

        return new GradeResource($deletedGrade);
    }
}
