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
        Schema::create('role_user', function (Blueprint $table) {
            // authorizable_id is the id of the user or the id of the model that has the role
            // authorizable_type is the class name of the
            $table->morphs('authorizable'); 
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->primary(['role_id', 'authorizable_id', 'authorizable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
