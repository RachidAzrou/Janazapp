<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 50)->unique();
            $table->string('status')->default('new'); // ENUM replaced with string
            $table->string('death_type'); // ENUM replaced with string
            $table->string('burial_type'); // ENUM replaced with string
            $table->json('deceased_details'); // JSON fields for details
            $table->json('death_details');
            $table->json('relative_details')->nullable();
            $table->json('location_details');
            $table->json('insurance_details')->nullable();
            $table->json('repatriation_details')->nullable();
            $table->foreignId('assigned_insurance_id')->nullable()->constrained('users');
            $table->foreignId('assigned_dispatcher_id')->nullable()->constrained('users');
            $table->foreignId('assigned_funeral_service_id')->nullable()->constrained('users');
            $table->foreignId('assigned_expeditor_id')->nullable()->constrained('users');
            $table->foreignId('assigned_hospital_id')->nullable()->constrained('users');
            $table->foreignId('assigned_mosque_id')->nullable()->constrained('users');
            $table->foreignId('assigned_mortuary_id')->nullable()->constrained('users');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->date('estimated_completion_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
}
