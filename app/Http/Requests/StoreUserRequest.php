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
            'firstname' => "required|string|min:4|max:30",
            'lastname' => "required|string|min:4|max:30",
            'middlename' => "sometimes|string|min:4|max:30",
            'email' => "required|email|",
            'password' => "required|string|min:5|max:30",
            'role_id' => "required|integer",
            'phone_number' => 'sometimes|string|min:11|max:11',
            'grade_id' => 'required|integer',
        ];
    }
}
