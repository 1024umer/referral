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
        Schema::table('blogs', function (Blueprint $table) {
            $table->tinyInteger('is_featured')->default(0);
        });
        Schema::table('services', function (Blueprint $table) {
            $table->tinyInteger('is_featured')->default(0);
        });
    }
};
