<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organization;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
    // Seed related data first
    Organization::factory()->count(20)->create(); // Create organizations

    // Seed users
    User::factory()->count(150)->create(); // Generate users

    // Seed cases
    $this->call(CasesTableSeeder::class);
}
}
