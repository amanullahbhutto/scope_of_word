<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('slug')->nullable()->after('name'); // Allow NULL initially
    });

    // Update existing products with unique slugs
    DB::statement("UPDATE products SET slug = CONCAT('product-', id) WHERE slug IS NULL OR slug = ''");

    Schema::table('products', function (Blueprint $table) {
        $table->string('slug')->unique()->change(); // Now apply the unique constraint
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropUnique(['slug']);
        $table->dropColumn('slug');
    });
}
};
