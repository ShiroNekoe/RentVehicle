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
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('id_vehicle')->nullable(); // add the vehicle foreign key
            $table->foreign('id_vehicle')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['id_vehicle']);
            $table->dropColumn('id_vehicle');
        });
    }
    
};
