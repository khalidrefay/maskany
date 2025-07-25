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
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->decimal('land_area', 10, 2)->nullable();
            $table->string('design')->default('modern');
            $table->string('finishing')->default('standard');
            $table->string('shape')->default('regular');
            $table->integer('floors')->default(1);
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('living_rooms')->default(0);
            $table->integer('kitchens')->default(0);
            $table->integer('annexes')->default(0);
            $table->integer('parking')->default(0);
            $table->decimal('required_area', 10, 2)->nullable();
            $table->text('terms')->nullable();
            $table->string('contact')->nullable();
            $table->bigInteger('estimate')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('location')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->enum('status', ['open', 'in_progress', 'completed', 'cancelled', 'awaiting_contractor_offers', ])->default('open');
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
