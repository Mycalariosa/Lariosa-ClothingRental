<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RentalStat;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rental_stats', function (Blueprint $table) {
            $table->id('rental_id');
            $table->enum('rental_status', ['pending', 'rented', 'confirmed', 'complete', 'cancel']);
            $table->timestamps();
        });

        // Seed the rental statuses
        $statuses = [
            ['rental_status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['rental_status' => 'rented', 'created_at' => now(), 'updated_at' => now()],
            ['rental_status' => 'confirmed', 'created_at' => now(), 'updated_at' => now()],
            ['rental_status' => 'complete', 'created_at' => now(), 'updated_at' => now()],
            ['rental_status' => 'cancel', 'created_at' => now(), 'updated_at' => now()]
        ];

        DB::table('rental_stats')->insert($statuses);
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_stats');
    }
};