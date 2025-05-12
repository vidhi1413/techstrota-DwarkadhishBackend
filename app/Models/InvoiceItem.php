<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'invoice_items';

    protected $fillable = [
        'invoice_id',
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
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoices::class);
    }

}
