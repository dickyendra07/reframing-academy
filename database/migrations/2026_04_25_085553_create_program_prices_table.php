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
        Schema::create('program_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_batch_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->unsignedBigInteger('amount');
            $table->text('description')->nullable();
            $table->boolean('requires_alumni_number')->default(false);
            $table->boolean('requires_group_name')->default(false);
            $table->string('requires_profession')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_prices');
    }
};