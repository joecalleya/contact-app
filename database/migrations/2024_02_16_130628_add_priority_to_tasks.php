<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * add columns in this way when deploying
     * we can run
     * php artisan make:migration add_priority_to_tasks;
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->tinyInteger('priority')->nullable()->default(1)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {

            $table->dropColumn('priority');

        });
    }
};
