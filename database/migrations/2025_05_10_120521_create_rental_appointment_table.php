<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('rentals', function (Blueprint $table) {
        $table->id(); // rental_id
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('clothes_id');
        $table->date('rental_date');
        $table->date('rental_return_date');
        $table->string('payment_method');
        $table->decimal('total_payment', 10, 2);
        $table->unsignedBigInteger('rentalstatus_id');
        $table->timestamps();

        // Foreign keys (optional but recommended)
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('clothes_id')->references('id')->on('clothes')->onDelete('cascade');
        $table->foreign('rentalstatus_id')->references('id')->on('rentalstatuses')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_appointment');
    }
};
