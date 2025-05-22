<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportArrangementsTable extends Migration
{
    public function up()
    {
        Schema::create('transport_arrangements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->string('transport_type', 50); // 'local', 'international', 'airport_transfer'
            $table->string('provider')->nullable();
            $table->json('vehicle_details')->nullable();
            $table->string('departure_location')->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->string('arrival_location')->nullable();
            $table->timestamp('estimated_arrival_time')->nullable();
            $table->timestamp('actual_arrival_time')->nullable();
            $table->string('status', 50)->default('scheduled'); // e.g., 'scheduled', 'in_transit', 'arrived'
            $table->string('tracking_number', 100)->nullable();
            $table->json('cost_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transport_arrangements');
    }
}
