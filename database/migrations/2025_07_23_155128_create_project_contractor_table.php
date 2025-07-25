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
        Schema::create('project_contractor', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->decimal('price', 12, 2);
    $table->integer('timeline'); // عدد الأيام
    $table->text('details');
    $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
    $table->timestamps();
    
    $table->unique(['project_id', 'user_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_contractor');
    }
};
