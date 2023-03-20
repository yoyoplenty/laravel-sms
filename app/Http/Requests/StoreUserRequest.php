<?php

namespace App\Http\Requests;

use App\Repositories\GradeRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {

    protected $roleRepository;
    protected $userRepository;
    protected $gradeRepository;
    protected $subjectRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        GradeRepository $gradeRepository,
        SubjectRepository $subjectRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->gradeRepository = $gradeRepository;
        $this->subjectRepository = $subjectRepository;
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
            'firstname' => "required|string|min:4|max:30",
            'lastname' => "required|string|min:4|max:30",
            'middlename' => "sometimes|string|min:4|max:30",
            'email' => [
                'required', 'email',
                function ($attributes, $value, $fail) {
                    $this->userRepository->getUserByEmail($value);
                }
            ],
            'password' => "required|string|min:5|max:30",
            'role_id' => [
                'required', 'integer',
                function ($attributes, $value, $fail) {
                    $this->roleRepository->findById($value);
                }
            ],
            'phone_number' => 'sometimes|string|min:11|max:11',
            'grade_id' => [
                'sometimes', 'integer',
                function ($attributes, $value, $fail) {
                    $this->gradeRepository->findById($value);
                }
            ],
            'subject_ids' => 'sometimes|array',
            'subject_ids.*' => [
                'required', 'integer', 'distinct',
                function ($attributes, $value, $fail) {
                    $this->subjectRepository->findById($value);
                    dd($value);
                }
            ]
        ];
    }
}
