<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('location');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->unsignedInteger('capacity');
            $table->string('status', 20)->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};