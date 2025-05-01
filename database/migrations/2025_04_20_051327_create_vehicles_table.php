<?php

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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_name');
            $table->enum('vehicle_type',['car','motorcycles']);
            $table->enum('vehicle_model',['big','medium','small']);
            $table->enum('vehicle_transmission',['matic','manual']);
            $table->enum('vehicle_brand',['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha']);
            $table->string('number_plate');
            $table->enum('seat',['2','5','8','12-20']);
            $table->decimal('price', 10, 2);
            $table->enum('status',['available','not available', 'maintenance','in_used'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
