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
        Schema::create('user_selections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->year('birth_year');
            $table->string('shirt_type');
            $table->string('shirt_size');
            $table->string('design_category');
            $table->boolean('resurge_2025')->default(0);
            $table->boolean('no_mercy')->default(0);
            $table->boolean('flower_of_snake')->default(0);
            $table->boolean('gordon')->default(0);
            $table->boolean('wing_of_love')->default(0);
            $table->boolean('nemesis')->default(0);
            $table->boolean('make_money_not_girlfriend')->default(0);
            $table->boolean('born_to_die')->default(0);
            $table->boolean('bloomrage')->default(0);
            $table->boolean('samurai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_selections');
    }
};
