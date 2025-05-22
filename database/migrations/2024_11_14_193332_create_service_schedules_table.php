<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('service_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('organizations')->onDelete('set null');
            $table->string('service_type', 50);
            $table->timestamp('scheduled_start');
            $table->timestamp('scheduled_end');
            $table->string('status', 50)->default('scheduled');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->constrained('users')->onDelete('set null');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_schedules');
    }
}

