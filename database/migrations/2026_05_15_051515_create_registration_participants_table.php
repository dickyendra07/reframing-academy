<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('participant_order')->default(1);
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('institution')->nullable();
            $table->string('shirt_size')->nullable();
            $table->string('glove_size')->nullable();
            $table->timestamps();

            $table->index(['registration_id', 'participant_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_participants');
    }
};
