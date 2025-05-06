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
        Schema::create('l_r__generates', function (Blueprint $table) {
            $table->increments('lr_generate_no');
            $table->string('invoice_no',10);
            $table->integer('value_rs');
            $table->string('lorry_no');
            $table->string('cnn_no',10);
            $table->string('delivery_at', 30);
            $table->datetime('date');
            $table->string('consignor',30);
            $table->string('consignor_gstin_no', 30);
            $table->string('consignor_eway_bill_no', 30);
            $table->string('consignee', 30);
            $table->string('consignee_gstin_no', 30);
            $table->string('consignee_eway_bill_no', 30);
            $table->string('from', 30);
            $table->string('to', 30);
            $table->string('insurance_company_name', 20);
            $table->integer('policy_no');
            $table->double('amount_rs', 8, 2);
            $table->double('risk_rs', 8, 2);
            $table->string('packages', 30);
            $table->string('destination', 30);
            $table->double('actual_weight', 8, 2);
            $table->double('rate_per_mt', 8, 2);
            $table->string('remarks', 30);
            $table->double('bc', 8, 2);
            $table->double('sgst', 8, 2);
            $table->double('cgst', 8, 2);
            $table->double('igst', 8, 2);
            $table->double('gc', 8, 2);
            $table->double('grand_total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_r__generates');
    }
};
