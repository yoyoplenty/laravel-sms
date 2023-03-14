<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $roles = Role::paginate();

        return new JsonResponse($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request) {
        $newRole = Role::create($request->only(['name']));

        return new JsonResponse($newRole);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) {
        return new JsonResponse($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role) {
        $updatedRole = $role->update($request->all());

        return new JsonResponse($updatedRole);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        return $role->delete();
    }
}
