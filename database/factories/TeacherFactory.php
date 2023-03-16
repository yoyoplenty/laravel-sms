<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'staff_id' => Str::random(10),
            'phone_number' => fake()->phoneNumber(11),
            'user_id' => FactoryHelper::getRandomModelId(User::class),
            'grade_id' => FactoryHelper::getRandomModelId(Grade::class),
        ];
    }
}
