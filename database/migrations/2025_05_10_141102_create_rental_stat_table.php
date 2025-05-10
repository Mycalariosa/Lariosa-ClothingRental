<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RentalStat;

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
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_stats');
    }
};