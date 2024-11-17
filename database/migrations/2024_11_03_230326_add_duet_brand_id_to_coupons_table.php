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
        Schema::table('coupons', function (Blueprint $table) {
            $table->unsignedBigInteger('duet_id')->nullable();
            $table->foreign('duet_id')->on('duets')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('duet_brand_id')->nullable();
            $table->foreign('duet_brand_id')->on('brands')->references('id')->cascadeOnDelete();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            //
        });
    }
};
