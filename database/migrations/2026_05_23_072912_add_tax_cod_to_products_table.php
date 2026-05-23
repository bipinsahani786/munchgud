<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('tax_type', ['inclusive', 'exclusive'])->default('inclusive')->after('is_featured');
            $table->decimal('gst_percent', 5, 2)->nullable()->after('tax_type');
            $table->boolean('cod_allowed')->default(true)->after('gst_percent');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['tax_type', 'gst_percent', 'cod_allowed']);
        });
    }
};
