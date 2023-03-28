<?php


namespace App\Http\Traits;

use Illuminate\Support\Facades\Gate;

trait GateTraits {

    public function authorizeUser($repository, $id) {
        $data = $repository->findById($id);

        abort_if(
            Gate::denies('edit-self', $data),
            response()->json([
                'message' => 'UnAuthorized',
                'success' => false,
            ], 403)
        );
    }
}
