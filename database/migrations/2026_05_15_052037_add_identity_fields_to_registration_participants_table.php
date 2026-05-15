<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration_participants', function (Blueprint $table) {
            $table->string('province')->nullable()->after('phone');
            $table->string('city')->nullable()->after('province');
            $table->string('education')->nullable()->after('profession');
            $table->string('nik_number')->nullable()->after('education');
            $table->string('str_number')->nullable()->after('nik_number');
        });
    }

    public function down(): void
    {
        Schema::table('registration_participants', function (Blueprint $table) {
            $table->dropColumn([
                'province',
                'city',
                'education',
                'nik_number',
                'str_number',
            ]);
        });
    }
};
