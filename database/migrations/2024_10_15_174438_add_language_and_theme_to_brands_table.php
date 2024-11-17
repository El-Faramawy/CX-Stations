<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('language', 10)->default('en');  // 'en' for English, 'ar' for Arabic
            $table->string('theme', 10)->default('dark');  // 'light' for light mode, 'dark' for dark mode
        });
    }

    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['language', 'theme']);
        });
    }
};
