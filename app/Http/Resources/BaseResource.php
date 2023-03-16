<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource {

    protected $code = 200;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'message' => 'request successful',
            'status' => $this->code,
            'data' => parent::toArray($request) ?? parent::toArray($request)
        ];
    }
}
