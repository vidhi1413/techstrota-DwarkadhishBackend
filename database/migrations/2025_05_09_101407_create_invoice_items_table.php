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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('lr_no', 30);
            $table->string('truck_no', 20);
            $table->string('from_to', 100);
            $table->string('material_parcel', 255);
            $table->float('total_weight');
            $table->float('freight_amount');
            $table->float('halting_charge');
            $table->float('extra_charge');
            $table->float('advance');
            $table->float('trip_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
