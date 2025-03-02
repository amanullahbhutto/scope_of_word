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
        Schema::table('users', function (Blueprint $table) {
            // Check if the 'phone' column doesn't exist before adding it
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('password');
            }

            // Similarly for other columns
            if (!Schema::hasColumn('users', 'region_id')) {
                $table->unsignedBigInteger('region_id')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('users', 'district_id')) {
                $table->unsignedBigInteger('district_id')->nullable()->after('region_id');
            }

            if (!Schema::hasColumn('users', 'tehsil_id')) {
                $table->unsignedBigInteger('tehsil_id')->nullable()->after('district_id');
            }

            if (!Schema::hasColumn('users', 'school_id')) {
                $table->string('school_id')->nullable()->after('tehsil_id');
            }

            if (!Schema::hasColumn('users', 'otp')) {
                $table->string('otp')->nullable()->after('school_id');
            }

            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('otp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'region_id',
                'district_id',
                'tehsil_id',
                'school_id',
                'otp',
                'address'
            ]);
        });
    }
};
