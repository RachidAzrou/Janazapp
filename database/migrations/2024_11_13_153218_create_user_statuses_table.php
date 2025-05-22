<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->unique();
            $table->timestamps();
        });

        // Insert the default statuses
        DB::table('user_statuses')->insert([
            ['status_name' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'inactive', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'suspended', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'pending_verification', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_statuses');
    }
}
