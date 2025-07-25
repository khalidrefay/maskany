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
        $table->foreignId('proposal_id')->constrained('project_proposals')->onDelete('cascade');
        $table->foreignId('contractor_id')->constrained('users')->onDelete('cascade');
        $table->decimal('price', 10, 2);
        $table->integer('timeline');
        $table->text('details')->nullable();
        $table->string('pdf_file')->nullable();
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('contractor_offers');
}
};
