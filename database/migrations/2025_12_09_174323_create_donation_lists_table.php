<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('donation_users')->onDelete('cascade');
            $table->string('full_name');
            $table->enum('type', ['toys', 'clothing', 'surprise_gift', 'money']);
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_lists');
    }
};

