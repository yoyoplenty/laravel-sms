<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateteacherRequest;
use App\Http\Resources\TeacherResource;
use App\Repositories\TeacherRepository;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller {

    protected $teacherRepository;

    public function __construct(TeacherRepository $repository) {
        $this->teacherRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse {
        $allteachers = $this->teacherRepository->paginate();

        return new JsonResponse([
            'message' => "successfully fetched all teachers",
            "status" => 200,
            "data" => $allteachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreteacherRequest $request): teacherResource {
        $createdteacher =  $this->teacherRepository->createTeacher($request->all());

        return new teacherResource($createdteacher);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): teacherResource {
        $teacherDetails =  $this->teacherRepository->findWithMissing($id);

        return new teacherResource($teacherDetails);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateteacherRequest $request, $id): teacherResource {
        $updatedteacher = $this->teacherRepository->update($id, $request->all());

        return new teacherResource($updatedteacher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): teacherResource {
        $this->teacherRepository->delete($id);

        return new teacherResource(null);
    }
}
