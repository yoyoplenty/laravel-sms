<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\StudentResource;
use App\Repositories\StudentRepository;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Traits\GateTraits;

/**
 * * @OA\Tag(
 *     name="Students",
 *     description="API Endpoints for Students"
 * )
 */

class StudentController extends BaseController {
    use GateTraits;

    protected $studentRepository;

    public function __construct(studentRepository $repository) {
        $this->studentRepository = $repository;

        $this->middleware('auth', ['except' => ['store']]);
    }

    /**
     * @OA\Get(
     *      path="/students",
     *      operationId="getProjectsList",
     *      tags={"Students"},
     *      summary="Get list of all students",
     *      description="Returns list of all students",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
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
        $this->authorizeUser($this->studentRepository, $id);

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
