<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LR_Generate extends Model
{
    use HasFactory;

    protected $table = 'l_r__generates';

    protected $fillable = [
        'invoice_no',
        'value_rs',
        'lorry_no',
        'cnn_no',
        'delivery_at',
        'date',
        'consignor',
        'consignor_gstin_no',
        'consignor_eway_bill_no',
        'consignee',
        'consignee_gstin_no',
        'consignee_eway_bill_no',
        'from',
        'to',
        'insurance_company_name',
        'policy_no',
        'amount_rs',
        'risk_rs',
        'gst_payer',
        'packages',
        'destination',
        'actual_weight',
        'rate_per_mt',
        'remarks',
        'bc',
        'sgst',
        'cgst',
        'igst',
        'gc',
        'grand_total',
    ];
}
