<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ChooseUs;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ChooseUs::insert([
            [
                'title' => 'Meet AOH',
                'description' => 'As a woman-owned business, Atomic Orbital Hydrogen Wave Vector (AOHWV) is fully...',
            ],
            [
                'title' => 'The AOH Difference',
                'description' => 'The importance of good service cannot be overstated, and at our company...',
            ],
            [
                'title' => 'A Security First Approach to Identity',
                'description' => 'Our approach to building and delivering a comprehensive service...',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ChooseUs::truncate();
    }
};
