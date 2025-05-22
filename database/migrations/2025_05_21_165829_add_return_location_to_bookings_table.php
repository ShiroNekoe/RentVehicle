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
        Schema::table('bookings', function (Blueprint $table) {
               $table->string('return_option')->default('showroom')->after('pickup_location');
            $table->string('return_location')->nullable()->after('return_option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
                $table->dropColumn('return_option');
            $table->dropColumn('return_location');
        });
    }
};
