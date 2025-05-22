<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersForeignKeyOnDelete extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['organization_id']);

            // Recreate the foreign key with ON DELETE SET NULL
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the updated foreign key
            $table->dropForeign(['organization_id']);

            // Recreate the original foreign key without ON DELETE SET NULL
            $table->foreign('organization_id')
                  ->references('id')
                  ->on('organizations')
                  ->onDelete('restrict');
        });
    }
}

