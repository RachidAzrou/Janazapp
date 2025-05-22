<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->string('type'); // Document type enum
            $table->string('file_path', 2048);
            $table->string('original_filename')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->integer('file_size')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('set null')->nullable();
            $table->string('status')->default('pending'); // Document status enum
            $table->text('verification_notes')->nullable();
            $table->foreignId('verified_by')->constrained('users')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->json('metadata')->default(json_encode([]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

