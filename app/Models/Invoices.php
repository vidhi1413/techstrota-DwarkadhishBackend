<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'lr_number',
        'truck_number',
        'from_to',
        'material_details',
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
        'invoice_value',
        'advance_received',
        'net_payable',
    ];
}
