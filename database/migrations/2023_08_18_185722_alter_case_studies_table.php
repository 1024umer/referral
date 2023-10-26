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
        Schema::table('case_studies', function (Blueprint $table) {
            $table->renameColumn('case_category_id', 'case_categories_ids');
        });
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('case_categories_ids')->change();
        });
    }
    public function down()
    {
        Schema::table('case_studies', function(Blueprint $table) {
            $table->renameColumn('case_categories_ids', 'case_category_id');
        });
    }
};
