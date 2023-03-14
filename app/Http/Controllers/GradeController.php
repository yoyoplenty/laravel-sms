<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Repositories\GradeRepository;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allGrades = Grade::query()->get();

        return new JsonResponse([
            'message' => "successfully fetched grades",
            "status" => 200,
            "data" => $allGrades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request, GradeRepository $gradeRepository) {
        $createdGrade = $gradeRepository->create($request->all());

        return new JsonResponse([
            'message' => "successfully created grade",
            "status" => 201,
            "data" => $createdGrade
        ]);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade) {
        return new JsonResponse([
            'message' => "successfully fetched grade",
            "status" => 201,
            "data" => $grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade, GradeRepository $gradeRepository) {
        $updatedGrade = $gradeRepository->update($grade, $request->all());

        return new JsonResponse([
            "message" => 'successfully updated',
            "status" => 200,
            "data" => $updatedGrade
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade, GradeRepository $gradeRepository) {
        $gradeRepository->delete($grade);

        return new JsonResponse([
            "message" => 'successfully deleted',
            "status" => 200,
            "data" => null
        ]);
    }
}
