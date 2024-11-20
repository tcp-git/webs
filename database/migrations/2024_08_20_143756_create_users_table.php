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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username',50)->after('id');
            $table->integer('role_id')->after('username');
            $table->integer('organization_id')->after('role_id');
            $table->mediumText('picture')->after('organization_id')->nullable();
            $table->integer('active')->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('username');
            $table->dropColumn('role_id');
            $table->dropColumn('organization_id');
            $table->dropColumn('picture');
            $table->dropColumn('active');
        });
    }
};
