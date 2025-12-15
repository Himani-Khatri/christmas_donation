<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('donation_lists', function (Blueprint $table) {
        if (!Schema::hasColumn('donation_lists', 'pickup_type')) {
            $table->enum('pickup_type', ['instant', 'scheduled'])->nullable()->after('payment_status');
        }

        if (!Schema::hasColumn('donation_lists', 'pickup_date')) {
            $table->date('pickup_date')->nullable()->after('pickup_type');
        }

        if (!Schema::hasColumn('donation_lists', 'status')) {
            $table->enum('status', ['pending', 'approved', 'picked_up', 'completed'])->default('pending')->after('pickup_date');
        }
    });
}


    public function down(): void
    {
        Schema::table('donation_lists', function (Blueprint $table) {
            $table->dropColumn(['pickup_type', 'pickup_date', 'status']);
        });
    }
};
