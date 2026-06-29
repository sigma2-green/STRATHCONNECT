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

    $table->enum('school', ['SCES','SBS','SLS','SHS']);
    $table->enum('course', ['ICS','BBIT','BCOM','CNA','LAW','Philosophy']);
    $table->enum('year_level', ['1st Year','2nd Year','3rd Year','4th Year']);

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
