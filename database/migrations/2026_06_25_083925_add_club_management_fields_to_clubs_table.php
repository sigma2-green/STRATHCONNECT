<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clubs', function (Blueprint $table) {

            $table->text('description')->nullable()->after('name');

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending')->after('banner');

            $table->foreignId('created_by_student_id')
    ->nullable()
    ->constrained('students')
    ->nullOnDelete()
    ->after('status');

$table->foreignId('created_by_lecturer_id')
    ->nullable()
    ->constrained('lecturers')
    ->nullOnDelete()
    ->after('created_by_student_id');
        });
    }

    public function down(): void
    {
        Schema::table('clubs', function (Blueprint $table) {

            $table->dropForeign(['created_by_student_id']);
$table->dropForeign(['created_by_lecturer_id']);

$table->dropColumn([
    'description',
    'status',
    'created_by_student_id',
    'created_by_lecturer_id',
]);
        });
    }
};
