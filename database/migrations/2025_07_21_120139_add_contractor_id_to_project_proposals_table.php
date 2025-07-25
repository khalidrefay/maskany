<?php
//C:\xampp\htdocs\maskany\database\migrations\2025_07_21_120139_add_contractor_id_to_project_proposals_table.php
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
       Schema::table('project_proposals', function (Blueprint $table) {
    $table->unsignedBigInteger('contractor_id')->nullable()->after('consultant_id');
    $table->foreign('contractor_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_proposals', function (Blueprint $table) {
            //
        });
    }
};
