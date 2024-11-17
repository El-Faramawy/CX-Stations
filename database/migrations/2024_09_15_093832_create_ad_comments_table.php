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
        Schema::create('ad_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Ad::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('comment')->nullable();
            $table->string('reply')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_comments');
    }
};
