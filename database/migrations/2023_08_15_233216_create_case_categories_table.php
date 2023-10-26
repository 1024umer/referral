<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CaseCategory;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('case_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->tinyInteger('is_active');
            $table->bigInteger('parent_id')->default(0);
            $table->timestamps();
        });
        $arr = [
            'Web Design',
            'UI UX Design',
            'Web Development',
            'Blockchain',
            'AI',

        ];
        CaseCategory::truncate();
        foreach($arr as $ar){
            CaseCategory::create([
                'name' => $ar,
                'slug' => str($ar)->slug(),
                'is_active' => 1,
                'parent_id' => 0
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_categories');
    }
};
