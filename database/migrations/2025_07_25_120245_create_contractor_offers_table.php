<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('contractor_offers')) {
            Schema::create('contractor_offers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('proposal_id');
                $table->unsignedBigInteger('contractor_id');
                $table->decimal('price', 10, 2);
                $table->integer('timeline');
                $table->text('details')->nullable();
                $table->string('pdf_file')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();

                $table->foreign('proposal_id')->references('id')->on('project_proposals')->onDelete('cascade');
                $table->foreign('contractor_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('contractor_offers');
    }
};