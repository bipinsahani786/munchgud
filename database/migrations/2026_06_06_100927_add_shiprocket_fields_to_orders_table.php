<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shiprocket_order_id')->nullable()->after('tracking_number');
            $table->string('shiprocket_shipment_id')->nullable()->after('shiprocket_order_id');
            $table->string('awb_code')->nullable()->after('shiprocket_shipment_id');
            $table->string('courier_company_id')->nullable()->after('awb_code');
            $table->string('shiprocket_status')->nullable()->after('courier_company_id');
            $table->timestamp('shiprocket_pushed_at')->nullable()->after('shiprocket_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shiprocket_order_id',
                'shiprocket_shipment_id',
                'awb_code',
                'courier_company_id',
                'shiprocket_status',
                'shiprocket_pushed_at',
            ]);
        });
    }
};
