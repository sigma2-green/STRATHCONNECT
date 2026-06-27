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
   Schema::create('events', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->text('description');

    $table->string('location');

    $table->string('banner')->nullable();

    $table->dateTime('start_datetime');
    $table->dateTime('end_datetime');

    $table->unsignedInteger('capacity')->nullable();

    $table->enum('visibility', [
        'public',
        'school',
        'course',
        'group',
        'club'
    ])->default('public');

    $table->enum('status', [
        'draft',
        'pending',
        'approved',
        'cancelled',
        'completed'
    ])->default('pending');

    $table->foreignId('created_by_student_id')
        ->nullable()
        ->constrained('students')
        ->nullOnDelete();

    $table->foreignId('created_by_lecturer_id')
        ->nullable()
        ->constrained('lecturers')
        ->nullOnDelete();

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
