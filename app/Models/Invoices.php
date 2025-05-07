<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'bill_to',
        'address',
        'gst_no',
        'branch',
        'invoice_no',
        'date',
        'lr_no',
        'truck_no',
        'from_to',
        'material_parcel',
        'total_weight',
        'freight_amount',
        'halting_charge',
        'extra_charge',
        'advance',
        'trip_amount',
        'hsn_sac',
        'remarks',
        'sub_total',
        'discount',
        'total_trip_amount',
        'invoice_value',
        'advance_received',
        'net_payable',
    ];
}
