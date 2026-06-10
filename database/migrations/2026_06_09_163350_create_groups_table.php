<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
Schema::create('groups', function (Blueprint $table) {

    $table->id();

    $table->string('name');

    $table->enum('type', [
        'school',
        'course',
        'year',
        'class'
    ]);

    $table->enum('school', [
        'SCES',
        'SBS',
        'SLS',
        'SHS'
    ]);

    $table->enum('course', [
        'ICS',
        'BBIT',
        'CNA',
        'LAW',
        'Philisophy'
    ])->nullable();

    $table->enum('year_level', [
        '1st Year',
        '2nd Year',
        '3rd Year',
        '4th Year'
    ])->nullable();

    $table->enum('student_group', [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F'
    ])->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
