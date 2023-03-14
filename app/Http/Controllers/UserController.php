<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {
    /** 
     * Display a listing of the resource.
     */
    public function index() {
        $allUser = User::query()->get();

        return new JsonResponse([
            'message' => "fetched users successfully",
            "status" => 200,
            "data" => $allUser
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, UserRepository $userRepository) {
        $user = $userRepository->create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, UserRepository $userRepository) {
        $updatedUser = $userRepository->update($user, $request->all());

        return new JsonResponse([
            "message" => 'successfully updated',
            "status" => 200,
            "data" => $updatedUser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserRepository $userRepository) {
        $userRepository->delete($user);

        return new JsonResponse([
            "message" => 'successfully deleted',
            "status" => 200,
            "data" => null
        ]);
    }
}
