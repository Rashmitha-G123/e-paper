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
    Schema::table('editions', function (Blueprint $table) {
        $table->string('publication_name')->after('publication_type');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('editions', function (Blueprint $table) {
        $table->dropColumn('publication_name');
    });
}

};
