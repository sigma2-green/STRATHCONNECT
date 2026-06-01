<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('username')->unique();
            $table->string('email')->unique();

            $table->string('student_number')->unique();

            // ENUMS (controlled options)
            $table->enum('school', [
                'SCES',
                'SBS',
                'SLS',
                'SHS',
            ]);

            $table->enum('course', [
                'ICS',
                'BBIT',
                'CNA',
                'LAW', 
                'Philisophy'
            ]);

            $table->enum('group', [
                'A',
                'B',
                'C',
                'D',
                'E',
                'F'
            ]);

            $table->string('password');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};