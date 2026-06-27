<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {

            $table->id();

            // Personal Information
            $table->string('name');
            $table->string('email')->unique();
            $table->string('staff_number')->unique();

            // Academic Information
            $table->enum('school', [
                'SCES',
                'SBS',
                'SLS',
                'SHS'
            ]);

            $table->enum('course', [
                'ICS',
                'BBIT',
                'BCOM',
                'CNA',
                'LAW',
                'Philosophy'
            ]);

            // Optional Information
            $table->string('phone')->nullable();
            $table->string('office')->nullable();

            // Admin Approval
            $table->boolean('approved')->default(false);

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};