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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('email')->nullable();
            $table->string('phone_code')->default('966');
            $table->string('phone')->unique()->index();
            $table->string('device_ip')->unique()->nullable();
            $table->string('otp_code')->nullable();
            $table->dateTime('code_created_at')->nullable();
            $table->foreignIdFor(\App\Models\Country::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(\App\Models\City::class)->index()->nullable()->constrained()->onDelete('set null');
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->integer('age')->nullable();
            $table->integer('points')->default(0);
            $table->enum('gender',['male','female'])->nullable();
            $table->enum('status',['pending','active','not_active'])->default('pending');
//            $table->rememberToken();
            $table->timestamps();
        });

//        Schema::create('password_reset_tokens', function (Blueprint $table) {
//            $table->string('email')->primary();
//            $table->string('token');
//            $table->timestamp('created_at')->nullable();
//        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};