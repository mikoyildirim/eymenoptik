<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->decimal('shipping_free_threshold', 10, 2)->default(3000)->after('about_text');
            $table->decimal('shipping_cost', 10, 2)->default(59.99)->after('shipping_free_threshold');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['shipping_free_threshold', 'shipping_cost']);
        });
    }
};