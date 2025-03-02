<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_consultation', function (Blueprint $table) {
            // Drop the foreign key constraint first (if it exists)
            $table->dropForeign(['disease_id']); 

            // Drop the column
            $table->dropColumn('disease_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down()
    {
        Schema::table('health_consultation', function (Blueprint $table) {
            $table->unsignedBigInteger('disease_id')->nullable();
            $table->foreign('disease_id')->references('disease_id')->on('disease_injuries')->onDelete('cascade');
        });
    }
};
