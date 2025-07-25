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
        Schema::create('contractor_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('contractor_id');
            $table->decimal('price', 12, 2);
            $table->integer('timeline')->nullable(); // المدة الزمنية بالأيام
            $table->text('details')->nullable();
            $table->string('pdf_file')->nullable(); // مسار ملف PDF
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('proposal_id')->references('id')->on('project_proposals')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractor_offers');
    }
};