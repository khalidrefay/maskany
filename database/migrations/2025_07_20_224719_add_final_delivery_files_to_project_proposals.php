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
    Schema::table('project_proposals', function (Blueprint $table) {
        $table->json('final_delivery_files')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('project_proposals', function (Blueprint $table) {
        $table->dropColumn('final_delivery_files');
    });
}

};
