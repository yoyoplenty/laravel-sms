<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allRoles = Role::paginate();

        return new JsonResponse([
            'message' => "successfully fetched roles",
            "status" => 200,
            "data" => $allRoles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request) {
        $newRole = Role::create($request->only(['name']));

        return new RoleResource($newRole);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) {
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role) {
        $updatedRole = $role->update($request->all());

        return new RoleResource($updatedRole);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        $deletedRole =  $role->delete();

        return new RoleResource($deletedRole);
    }
}
