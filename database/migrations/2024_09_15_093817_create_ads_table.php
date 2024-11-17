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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('title')->nullable();
            $table->tinyInteger('is_vip')->default(0);
            $table->dateTime('vip_date')->nullable();
            $table->integer('share_number')->default(0);
            $table->integer('view_number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
