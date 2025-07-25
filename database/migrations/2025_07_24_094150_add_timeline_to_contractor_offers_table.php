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
    Schema::table('contractor_offers', function (Blueprint $table) {
        $table->integer('timeline')->after('price')->comment('المدة الزمنية بالأيام');
    });
}

public function down()
{
    Schema::table('contractor_offers', function (Blueprint $table) {
        $table->dropColumn('timeline');
    });
}
};
