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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_vehicle')->constrained('vehicles');
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_driver')->nullable()->constrained('drivers')->onDelete('set null'); 
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->enum('booking_status', ['ongoing', 'completed', 'cancelled'])->default('ongoing');
            $table->date('booking_date');
            $table->string('phone_security');
            $table->string('phone_person');
            $table->string('nik_identity');
            $table->string('identity');
            $table->decimal('booking_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
