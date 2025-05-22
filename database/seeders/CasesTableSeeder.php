<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class CasesTableSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['new', 'pending_verification', 'in_progress', 'pending_documents', 'pending_approval', 'approved', 'in_transit', 'completed', 'cancelled', 'on_hold'];

        $deathTypes = ['natural', 'accident', 'hospital', 'other'];
        $burialTypes = ['local', 'repatriation'];

        // Fetch user IDs with the specific roles
        $insuranceUserIds = User::where('role_id', 2) // Assuming '1' corresponds to the 'dispatcher' role
            ->pluck('id')
            ->toArray();

        $dispatcherUserIds = User::where('role_id', 3) // Assuming '1' corresponds to the 'dispatcher' role
            ->pluck('id')
            ->toArray();

        $funeralServiceUserIds = User::where('role_id', 4) // Assuming '2' corresponds to the 'funeral_service' role
            ->pluck('id')
            ->toArray();

        $expeditorUserIds = User::where('role_id', 5) // Assuming '3' corresponds to the 'expeditor' role
            ->pluck('id')
            ->toArray();

        $hospitalUserIds = User::where('role_id', 6) // Assuming '4' corresponds to the 'hospital' role
            ->pluck('id')
            ->toArray();

        $mosqueUserIds = User::where('role_id', 7) // Assuming '5' corresponds to the 'mosque' role
            ->pluck('id')
            ->toArray();

        $mortuaryUserIds = User::where('role_id', 8) // Assuming '6' corresponds to the 'mortuary' role
            ->pluck('id')
            ->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('cases')->insert([
                'reference_number' => Str::uuid(),
                'status' => $statuses[array_rand($statuses)],
                'death_type' => $deathTypes[array_rand($deathTypes)],
                'burial_type' => $burialTypes[array_rand($burialTypes)],
                'deceased_details' => json_encode([
                    'name' => fake()->name(),
                    'age' => fake()->numberBetween(20, 90),
                    'gender' => fake()->randomElement(['male', 'female']),
                ]),
                'death_details' => json_encode([
                    'cause' => fake()->sentence(),
                    'date' => fake()->date(),
                ]),
                'relative_details' => json_encode([
                    'name' => fake()->name(),
                    'relation' => fake()->randomElement(['spouse', 'parent', 'sibling', 'child']),
                    'contact' => fake()->phoneNumber(),
                ]),
                'location_details' => json_encode([
                    'city' => fake()->city(),
                    'country' => fake()->country(),
                ]),
                'insurance_details' => json_encode([
                    'policy_number' => fake()->numerify('INS-#####'),
                    'provider' => fake()->company(),
                ]),
                'repatriation_details' => json_encode([
                    'destination' => fake()->city() . ', ' . fake()->country(),
                    'expected_date' => fake()->date(),
                ]),
                'assigned_insurance_id' => $insuranceUserIds[array_rand($insuranceUserIds)],
                'assigned_dispatcher_id' => $dispatcherUserIds[array_rand($dispatcherUserIds)],
                'assigned_funeral_service_id' => $funeralServiceUserIds[array_rand($funeralServiceUserIds)],
                'assigned_expeditor_id' => $expeditorUserIds[array_rand($expeditorUserIds)],
                'assigned_hospital_id' => $hospitalUserIds[array_rand($hospitalUserIds)],
                'assigned_mosque_id' => $mosqueUserIds[array_rand($mosqueUserIds)],
                'assigned_mortuary_id' => $mortuaryUserIds[array_rand($mortuaryUserIds)],
                'created_by' => fake()->numberBetween(1, 10),
                'estimated_completion_date' => fake()->date(),
                'completed_at' => fake()->dateTime(),
                'cancelled_at' => fake()->dateTime(),
                'cancellation_reason' => fake()->sentence(),
                'notes' => fake()->optional()->paragraph(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
