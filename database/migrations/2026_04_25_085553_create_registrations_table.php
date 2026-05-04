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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_batch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_price_id')->constrained()->cascadeOnDelete();

            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('institution')->nullable();

            $table->string('profession')->nullable();
            $table->string('education')->nullable();
            $table->string('nik_number')->nullable();
            $table->string('str_number')->nullable();

            $table->string('alumni_number')->nullable();
            $table->string('group_name')->nullable();

            $table->unsignedBigInteger('base_price')->default(0);
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('total_amount')->default(0);

            $table->string('payment_type')->default('full_payment');
            $table->unsignedBigInteger('dp_amount')->nullable();

            $table->string('registration_status')->default('waiting_payment');
            $table->string('payment_status')->default('unpaid');
            $table->string('document_status')->default('pending_review');

            $table->timestamp('terms_accepted_at')->nullable();
            $table->timestamp('data_confirmation_accepted_at')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};