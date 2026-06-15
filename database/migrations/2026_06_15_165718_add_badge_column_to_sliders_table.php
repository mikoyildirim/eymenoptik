<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('sliders', 'text')) {
                $table->text('text')->nullable()->after('title');
            }

            if (!Schema::hasColumn('sliders', 'button_text')) {
                $table->string('button_text')->nullable()->after('text');
            }

            if (!Schema::hasColumn('sliders', 'button_url')) {
                $table->string('button_url')->nullable()->after('button_text');
            }

            if (!Schema::hasColumn('sliders', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('image');
            }

            if (!Schema::hasColumn('sliders', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $columns = [
                'text',
                'button_text',
                'button_url',
                'sort_order',
                'is_active',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('sliders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};