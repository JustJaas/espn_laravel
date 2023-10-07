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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->text("guid")->nullable();
            $table->text("uid")->nullable();
            $table->text("slug")->nullable();
            $table->text("location")->nullable();
            $table->text("name")->nullable();
            $table->text("nickname")->nullable();
            $table->text("abbreviation")->nullable();
            $table->text("displayName")->nullable();
            $table->text("shortDisplayName")->nullable();
            $table->text("isActive")->nullable();
            $table->text("isAllStar")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
