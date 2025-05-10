<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RentalApp;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rental_apps', function (Blueprint $table) {
            $table->id('rental_id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('clothes_id');
            $table->date('rental_date');
            $table->date('return_date');
            $table->string('payment_method');
            $table->decimal('total_payment', 10, 2);

            $table->unsignedBigInteger('rental_status_id');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clothes_id')->references('clothes_id')->on('clothes')->onDelete('cascade');
            $table->foreign('rental_status_id')->references('rental_id')->on('rental_stats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_apps');
    }
};