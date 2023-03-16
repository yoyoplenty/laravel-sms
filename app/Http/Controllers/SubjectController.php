<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Repositories\SubjectRepository;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller {

    protected $subjectRepository;

    public function __construct(SubjectRepository $repository) {
        $this->subjectRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allSubjects = $this->subjectRepository->paginate();

        return new JsonResponse([
            'message' => "successfully fetched subjects",
            "status" => 200,
            "data" => $allSubjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request) {
        $createdSubject = $this->subjectRepository->createSubject($request->all());

        return new SubjectResource($createdSubject);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $subjectWithGrades =  $this->subjectRepository->findWithMissing($id);

        return new SubjectResource($subjectWithGrades);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, $id) {
        $updatedSubject = $this->subjectRepository->update($id, $request->all());

        return new SubjectResource($updatedSubject);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->subjectRepository->delete($id);

        return new SubjectResource(null);
    }
}
