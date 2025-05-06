<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function store(Request $request)
    {
        try{
            // Validate the request data
            $validatedData = $request->validate([
                'lr_number' => 'required|string|max:30',
                'truck_number' => 'required|string|max:20',
                'from_to' => 'required|string|max:100',
                'material_details' => 'required|string|max:255',
                'total_weight' => 'required|numeric',
                'freight_amount' => 'required|numeric',
                'halting_charge' => 'required|numeric',
                'extra_charge' => 'required|numeric',
                'advance' => 'required|numeric',
                'trip_amount' => 'required|numeric',
                'hsn_sac' => 'required|string|max:20',
                'remarks' => 'required|string',
                'sub_total' => 'required|numeric',
                'discount' => 'required|numeric',
                'invoice_value' => 'required|numeric',
                'advance_received' => 'required|numeric',
                'net_payable' => 'required|numeric',
            ],[
                'lr_number.required' => 'LR number is required.',
                'truck_number.required' => 'Truck number is required.',
                'from_to.required' => 'From-To field is required.',
                'total_weight.required' => 'Total weight is required.',
                'freight_amount.required' => 'Freight amount is required.',
                'halting_charge.required' => 'Halting charge is required.',
                'extra_charge.required' => 'Extra charge is required.',
                'advance.required' => 'Advance is required.',
                'trip_amount.required' => 'Trip amount is required.',
                'sub_total.required' => 'Sub-total is required.',
                'discount.required' => 'Discount is required.',
                'invoice_value.required' => 'Invoice value is required.',
                'advance_received.required' => 'Advance received is required.',
                'net_payable.required' => 'Net payable is required.',
            ]);

            // Create a new invoice
            $invoice = Invoices::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Invoice created successfully',
                'data' => $invoice
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
