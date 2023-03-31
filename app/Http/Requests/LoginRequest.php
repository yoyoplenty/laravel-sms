<?php

namespace App\Http\Requests;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

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
            'email' => "required|email|exists:App\Models\User,email",
            'password' => "required|string|min:5|max:30",
            'role_id' => 'integer|exists:App\Models\Role,id',
            //TODO add user type
        ];
    }
}
