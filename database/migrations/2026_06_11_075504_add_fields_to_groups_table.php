<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('name')->after('id');

            $table->enum('type', [
                'school',
                'course',
                'year',
                'class'
            ])->after('name');

            $table->enum('school', [
                'SCES',
                'SBS',
                'SLS',
                'SHS'
            ])->after('type');

            $table->enum('course', [
                'ICS',
                'BBIT',
                'CNA',
                'LAW',
                'Philisophy'
            ])->nullable()->after('school');

            $table->enum('year_level', [
                '1st Year',
                '2nd Year',
                '3rd Year',
                '4th Year'
            ])->nullable()->after('course');

            $table->enum('student_group', [
                'A',
                'B',
                'C',
                'D',
                'E',
                'F'
            ])->nullable()->after('year_level');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'type',
                'school',
                'course',
                'year_level',
                'student_group'
            ]);
        });
    }
};