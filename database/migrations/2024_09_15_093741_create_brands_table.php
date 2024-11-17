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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('email')->nullable();
            $table->string('phone_code')->default('966');
            $table->string('phone')->unique()->index();
            $table->string('otp_code')->nullable();
            $table->dateTime('code_created_at')->nullable();
            $table->string('commercial_number')->unique()->index();
            $table->foreignIdFor(\App\Models\Country::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(\App\Models\City::class)->index()->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(\App\Models\Category::class)->index()->nullable()->constrained()->onDelete('set null');
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('panner')->nullable();
            $table->integer('points')->nullable();
            $table->enum('status',['pending','active','not_active'])->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->integer('rate')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('discount_points')->default(0);
            $table->integer('discount_hours')->default(24);
            $table->timestamp('discount_points_last_updated')->nullable();
            $table->timestamp('discount_last_updated')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('insta')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('website')->nullable();
            $table->text('about',500)->nullable();
            $table->text('address',500)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
