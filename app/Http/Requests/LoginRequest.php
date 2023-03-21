<?php

namespace App\Http\Requests;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


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
            'email' => [
                'required', 'email',
                function ($attributes, $value, $fail) {
                    $this->userRepository->findByField($attributes, $value);
                }
            ],
            'password' => "required|string|min:5|max:30",
            'role_id' => [
                'required', 'integer',
                function ($attributes, $value, $fail) {
                    $this->roleRepository->findById($value);
                }
            ],
            //TODO add user type
        ];
    }
}
