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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("league_id");
            $table->text("year")->nullable();
            $table->text("startDate")->nullable();
            $table->text("endDate")->nullable();
            $table->text("displayName")->nullable();
            $table->text("shortDisplayName")->nullable();
            $table->text("abbreviation")->nullable();
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
