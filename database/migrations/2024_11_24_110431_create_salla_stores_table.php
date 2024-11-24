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
        Schema::create('salla_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class)->nullable()->constrained()->onDelete('cascade');
            $table->string('client_id',500)->nullable();
            $table->string('client_secret',500)->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salla_stores');
    }
};
