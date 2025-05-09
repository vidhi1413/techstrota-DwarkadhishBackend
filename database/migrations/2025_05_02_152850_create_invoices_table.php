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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('bill_to', 30);
            $table->string('address', 50);
            $table->string('gst_no', 15);
            $table->integer('branch');
            $table->string('invoice_no', 10);
            $table->datetime('date');
            $table->string('lr_no', 30);
            $table->string('truck_no', 20);
            $table->string('from_to', 100);
            $table->string('material_parcel', 255);
            $table->float('total_weight', 8, 2);
            $table->float('freight_amount', 10, 2)->default(0);
            $table->float('halting_charge', 10, 2)->default(0);
            $table->float('extra_charge', 10, 2)->default(0);
            $table->float('advance', 10, 2)->default(0);
            $table->float('trip_amount', 10, 2)->default(0);
            $table->string('hsn_sac', 20);
            $table->text('remarks');
            $table->float('sub_total', 10, 2)->default(0);
            $table->float('discount', 10, 2)->default(0);
            $table->float('total_trip_amount', 10, 2)->default(0);
            $table->float('invoice_value', 10, 2)->default(0);
            $table->float('advance_received', 10, 2)->default(0);
            $table->float('net_payable', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
