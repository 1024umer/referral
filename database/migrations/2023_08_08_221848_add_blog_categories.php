<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $arr = [
            'Technology',
            'Investigation',
            'Threats',
            'Strategy',
        ];
        Category::truncate();
        foreach($arr as $ar){
            Category::create([
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
        Category::truncate();
    }
};
