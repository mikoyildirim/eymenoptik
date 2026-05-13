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
    Schema::create('site_settings', function (Blueprint $table) {
        $table->id();

        $table->string('site_name')->default('Eymen Optik');
        $table->string('logo')->nullable();
        $table->string('favicon')->nullable();

        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->text('address')->nullable();

        $table->string('instagram')->nullable();
        $table->string('facebook')->nullable();
        $table->string('whatsapp')->nullable();

        $table->text('about_text')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
