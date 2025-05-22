<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserStatus;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Generate a random company name
            'type' => $this->faker->word, // Replace with appropriate types if needed
            'registration_number' => $this->faker->optional()->word,
            'tax_number' => $this->faker->optional()->word,
            'address_line1' => $this->faker->address,
            'address_line2' => $this->faker->optional()->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'operating_hours' => json_encode([
                'monday' => '9:00 AM - 5:00 PM',
                'tuesday' => '9:00 AM - 5:00 PM',
                'wednesday' => '9:00 AM - 5:00 PM',
                'thursday' => '9:00 AM - 5:00 PM',
                'friday' => '9:00 AM - 5:00 PM',
            ]),
            'user_status_id' => $this->getRandomOrDefault(UserStatus::class, 4), // Default to 4 (pending_verification) if no statuses exist
            'verification_status' => 'pending',
            'settings' => json_encode([]),
        ];
    }

    private function getRandomOrDefault(string $modelClass, $default = null): mixed
    {
        return $modelClass::query()->inRandomOrder()->value('id') ?? $default;
    }
}
