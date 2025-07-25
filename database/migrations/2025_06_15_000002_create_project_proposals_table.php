<?php
//
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreignId('consultant_id')->constrained('users')->onDelete('cascade');
            $table->json('design_plans');
            $table->string('materials_list');
            $table->decimal('price', 12, 2);
            $table->integer('duration');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->decimal('rating', 3, 2)->nullable();
            $table->timestamps();

            $table->foreign('project_id', 'fk_project_proposals_project_items')
                ->references('id')
                ->on('project_items')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_proposals');
    }
};
