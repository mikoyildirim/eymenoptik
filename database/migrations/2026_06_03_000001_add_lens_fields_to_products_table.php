<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('lens_degree')->nullable()->after('glass_type');
            $table->string('lens_type')->nullable()->after('lens_degree');
            $table->string('lens_usage')->nullable()->after('lens_type');
            $table->string('lens_package_content')->nullable()->after('lens_usage');
            $table->string('lens_water_content')->nullable()->after('lens_package_content');
            $table->string('lens_base_curve')->nullable()->after('lens_water_content');
            $table->string('lens_diameter')->nullable()->after('lens_base_curve');
            $table->string('lens_material')->nullable()->after('lens_diameter');
            $table->string('lens_center_thickness')->nullable()->after('lens_material');
            $table->string('lens_oxygen_permeability')->nullable()->after('lens_center_thickness');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'lens_degree',
                'lens_type',
                'lens_usage',
                'lens_package_content',
                'lens_water_content',
                'lens_base_curve',
                'lens_diameter',
                'lens_material',
                'lens_center_thickness',
                'lens_oxygen_permeability',
            ]);
        });
    }
};
