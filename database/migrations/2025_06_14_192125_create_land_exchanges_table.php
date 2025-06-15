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
        Schema::create('land_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('current_location');
            $table->decimal('current_area', 10, 2);
            $table->string('desired_locations')->nullable(); // JSON array of desired locations
            $table->decimal('price', 15, 2)->nullable();
            $table->boolean('for_sale')->default(false);
            $table->boolean('for_exchange')->default(false);
            $table->string('phone_number');
            $table->string('image')->nullable(); // Path to the uploaded image
            $table->string('map_coordinates')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_exchanges');
    }
};
