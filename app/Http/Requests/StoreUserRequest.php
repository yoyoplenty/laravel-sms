<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'firstname' => "required|string|mim:4|max:4",
            'lastname' => "required|string|mim:4|max:4",
            'email' => "required|email|",
            'password' => "required|string|mim:5|max:5",
            'role' => "required|integer",
            'phone_number' => 'sometimes|string|min:11|max:11'
        ];
    }
}
