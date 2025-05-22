<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('set null');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('set null');
            $table->string('message_type');  // Store as string (ENUM equivalent)
            $table->text('content');
            $table->json('metadata')->default(json_encode([]));
            $table->string('status')->default('sent');  // Store as string (ENUM equivalent)
            $table->timestamp('read_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
