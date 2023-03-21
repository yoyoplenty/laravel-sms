<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Repositories\RoleRepository;

class RoleController extends BaseController {

    protected $roleRepository;

    public function __construct(RoleRepository $repository) {
        $this->roleRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allRoles = $this->roleRepository->paginate();

        return $this->sendResponse(
            RoleResource::collection($allRoles),
            "successfully fetched roles"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request) {
        $createdRole = $this->roleRepository->createRole($request->only(['name']));

        return $this->sendResponse(
            new RoleResource($createdRole),
            "successfully created role"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $role = $this->roleRepository->findById($id);

        return $this->sendResponse(new roleResource($role));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, $id) {
        $updatedRole = $this->roleRepository->update($id, $request->all());

        return $this->sendResponse(new RoleResource($updatedRole));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $this->roleRepository->delete($id);

        return $this->sendResponse(new RoleResource(null));
    }
}
