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
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('landmark', 50)->nullable()->after('line2');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_landmark', 50)->nullable()->after('shipping_line2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('landmark');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_landmark');
        });
    }
};
