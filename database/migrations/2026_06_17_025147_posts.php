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
    Schema::create('posts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('group_id')->constrained()->cascadeOnDelete();

    $table->foreignId('student_id')
          ->nullable()
          ->constrained()
          ->nullOnDelete();

    $table->foreignId('lecturer_id')
          ->nullable()
          ->constrained()
          ->nullOnDelete();

    $table->text('content')->nullable();

    $table->string('attachment')->nullable();
    $table->string('attachment_type')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('posts');
}
};
