<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller {

    protected $userRepository;

    public function __construct(UserRepository $repository) {
        $this->userRepository = $repository;

        $this->middleware('auth', ['except' => ['store']]);
        $this->middleware('role:admin', ['only' => ['index']]);
    }

    /** 
     * Display a listing of the resource.
     */
    public function index(): JsonResponse {
        $allUser = $this->userRepository->paginate();;

        return new JsonResponse([
            'message' => "fetched users successfully",
            "status" => 200,
            "data" => $allUser
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): UserResource {
        $user = $this->userRepository->createUser($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): UserResource {
        $user = $this->userRepository->findById($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id): UserResource {
        $updatedUser = $this->userRepository->update($id, $request->all());;

        return new UserResource($updatedUser);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): UserResource {
        $this->userRepository->delete($id);

        return new UserResource(null);
    }
}
