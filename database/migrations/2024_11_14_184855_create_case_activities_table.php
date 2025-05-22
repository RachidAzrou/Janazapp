<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('case_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->string('activity_type');
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->text('description');
            $table->json('metadata')->default(json_encode([]));
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('case_activities');
    }
}
