<?php

namespace Database\Factories;

use App\Models\Role;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'firstname' => fake()->name(),
            'lastname' => fake()->name(),
            'middlename' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role_id' => FactoryHelper::getRandomModelId(Role::class),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified() {
        //
    }
}
