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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("company_name");
            $table->string("company_website")->nullable();
            $table->string("position_title");
            $table->string("position_level");
            $table->string("industry");
            $table->string("specialization");
            $table->string("description", 800)->nullable();
            $table->boolean("current");
            $table->date("from");
            $table->date("to")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
