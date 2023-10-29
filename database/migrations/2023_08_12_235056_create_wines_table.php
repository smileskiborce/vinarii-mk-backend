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
        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('region');
            $table->unsignedSmallInteger('vintage');
            $table->unsignedDouble('price');
            $table->unsignedInteger('wine_type');
            $table->unsignedDouble('rating');
            $table->string('country');
            $table->text('description');
            $table->unsignedDouble('alcohol_content');
            $table->unsignedDouble('size_liters');
            $table->unsignedInteger('sort')->default(0);

            $table->foreignId('winery_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wines');
    }
};
