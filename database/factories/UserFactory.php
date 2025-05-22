<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Organization;
use App\Models\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->boolean(80) ? now() : null, // 80% chance of being verified
            'password' => bcrypt('password'), // Or use Hash::make('password') if needed
            'remember_token' => Str::random(10),
            'role_id' => $this->getRandomOrDefault(UserRole::class),
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'phone' => $this->faker->optional()->phoneNumber,
            'whatsapp_id' => $this->faker->optional()->numerify('whatsapp-##########'),
            'profile_photo_path' => $this->faker->optional()->imageUrl(200, 200, 'people'),
            'user_status_id' => $this->getRandomOrDefault(UserStatus::class, 4), // Default to 4 (pending_verification) if no statuses exist
            'phone_verified_at' => $this->faker->boolean(70) ? now() : null, // 70% chance of being verified
            'settings' => json_encode([]), // Default empty JSON object
            'last_login_at' => $this->faker->optional(50)->dateTimeThisYear, // 50% chance of a last login
        ];
    }

    /**
     * Helper method to get a random record's ID or default to null/other value.
     */
    private function getRandomOrDefault(string $modelClass, $default = null): mixed
    {
        return $modelClass::query()->inRandomOrder()->value('id') ?? $default;
    }
}
