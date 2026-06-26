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

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('students')
                ->nullOnDelete()
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('clubs', function (Blueprint $table) {

            $table->dropForeign(['created_by']);

            $table->dropColumn([
                'description',
                'status',
                'created_by'
            ]);
        });
    }
};
