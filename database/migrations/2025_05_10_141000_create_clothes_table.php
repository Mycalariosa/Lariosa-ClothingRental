<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Clothes;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('clothes', function (Blueprint $table) {
            $table->id('clothes_id'); // Primary key
            $table->string('brand');
            $table->string('category');
            $table->string('size');
            $table->decimal('price', 8, 2);
            $table->string('color');
            $table->string('material');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clothes');
    }
};
