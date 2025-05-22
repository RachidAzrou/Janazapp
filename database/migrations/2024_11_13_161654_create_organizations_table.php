<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Create the organizations table
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Replacing enum with string for SQLite compatibility
            $table->string('type');
            $table->string('registration_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->json('operating_hours')->nullable();
            $table->foreignId('user_status_id')->nullable()->constrained('user_statuses')->default(4); // Default is 'pending_verification'
            $table->string('verification_status')->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->json('settings')->default(json_encode([]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Drop the organizations table
        Schema::dropIfExists('organizations');
    }
}
