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
    Schema::create('clothes', function (Blueprint $table) {
        $table->id(); // clothes_id
        $table->string('brand');
        $table->string('category');
        $table->string('size');
        $table->decimal('price', 10, 2);
        $table->string('color');
        $table->string('material');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes');
    }
};
