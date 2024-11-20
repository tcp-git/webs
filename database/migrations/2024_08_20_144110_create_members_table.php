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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->string('reference1',20)->nullable();
            $table->string('reference2',20)->nullable();
            $table->string('reference3',20)->nullable();
            $table->boolean('doctor')->nullable();
            $table->boolean('moderator');
            $table->boolean('mic');
            $table->boolean('vdo');
            $table->boolean('shared');
            $table->integer('created_user_id');
            $table->integer('updated_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
