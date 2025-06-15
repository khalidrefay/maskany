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
        Schema::create('project_items', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('district');
            $table->float('land_area');
            $table->string('design');
            $table->string('finishing');
            $table->string('shape');
            $table->integer('floors')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('living_rooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('kitchens')->nullable();
            $table->integer('annexes')->nullable();
            $table->integer('parking')->nullable();
            $table->float('required_area')->nullable();
            $table->boolean('terms')->default(false);
            $table->boolean('contact')->default(false);
            $table->bigInteger('estimate')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_items');
    }
};
