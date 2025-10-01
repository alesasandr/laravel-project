<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Удаляем записи без author_id, чтобы не нарушить целостность
        \DB::table('comments')->whereNull('author_id')->delete();

        Schema::table('comments', function (Blueprint $table) {
            // Удаляем колонку author
            $table->dropColumn('author');
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('author')->nullable();
        });
    }
};
