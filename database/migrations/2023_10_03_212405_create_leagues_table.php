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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_id');
            $table->text('guid')->nullable();
            $table->text('uid')->nullable();
            $table->text("name")->nullable();
            $table->text('shortName')->nullable();
            $table->text('midsizeName')->nullable();
            $table->text('slug')->nullable();
            $table->text('abbreviation')->nullable();
            $table->text('isTournament')->nullable();
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
