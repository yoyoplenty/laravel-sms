<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Repositories\SubjectRepository;

class SubjectController extends BaseController {

    protected $subjectRepository;

    public function __construct(SubjectRepository $repository) {
        $this->subjectRepository = $repository;

        $this->middleware('auth');
        $this->middleware('role:admin,teacher', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allSubjects = $this->subjectRepository->paginate();

        return $this->sendResponse(
            SubjectResource::collection($allSubjects),
            "successfully fetched subjects"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request) {
        $createdSubject = $this->subjectRepository->createSubject($request->all());

        return $this->sendResponse(
            new SubjectResource($createdSubject),
            "successfully created subject"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $subjectWithGrades =  $this->subjectRepository->findWithMissing($id);

        return $this->sendResponse(new SubjectResource($subjectWithGrades));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, $id) {
        $updatedSubject = $this->subjectRepository->update($id, $request->all());

        return $this->sendResponse(new SubjectResource($updatedSubject));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->subjectRepository->delete($id);

        return $this->sendResponse(null, 'Deleted successfully');
    }
}
