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
        Schema::table('donation_lists', function (Blueprint $table) {
            $table->string('pickup_type')->nullable(); // instant | scheduled
            $table->date('pickup_date')->nullable();
            $table->string('status')->default('pending'); 
            // pending | approved | picked_up | completed
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_lists', function (Blueprint $table) {
            //
        });
    }
};
