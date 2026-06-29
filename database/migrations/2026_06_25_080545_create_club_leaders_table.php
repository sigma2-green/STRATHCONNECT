<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_leaders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('club_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('position');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_leaders');
    }
};