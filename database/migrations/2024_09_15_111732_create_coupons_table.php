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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class)->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained()->onDelete('cascade');
            $table->integer('hours')->nullable();
            $table->integer('discount')->default(0);
            $table->double('total_purchases')->default(0);
            $table->double('total_after_discount')->default(0);
            $table->enum('status',['pending','rejected','complete'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
