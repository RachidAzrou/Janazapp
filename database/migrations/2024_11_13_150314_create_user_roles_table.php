<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique(); // e.g., admin, dispatcher
            $table->timestamps();
        });

        // Insert the default statuses
        DB::table('user_roles')->insert([
            ['role_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'insurance_agent', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'dispatcher', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'funeral_service', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'expeditor', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'hospital_staff', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'mosque_admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'mortuary_admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'user', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
