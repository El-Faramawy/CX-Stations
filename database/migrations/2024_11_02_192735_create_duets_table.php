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
        Schema::create('duets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand1_id')->nullable();
            $table->foreign('brand1_id')->on('brands')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('brand2_id')->nullable();
            $table->foreign('brand2_id')->on('brands')->references('id')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('brand1_discount', 5, 2);
            $table->decimal('brand2_discount', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duets');
    }
};
