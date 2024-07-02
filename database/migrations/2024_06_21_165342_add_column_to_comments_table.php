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
        Schema::table('comments', function (Blueprint $table) {
            $table->after('text', function(Blueprint $table){
                $table->integer('reactions_count')->default(0);
                $table->integer('replies_count')->default(0);
                $table->foreignUuid('post_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('reactions_count');
            $table->dropColumn('replies_count');
            $table->dropColumn('post_id');

        });
    }
};
