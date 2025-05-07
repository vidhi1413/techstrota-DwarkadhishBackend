<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\LR_Generate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesController extends Controller
{  
    public function calculateNetPayable(Request $request)
{
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'trip_amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'advance_received' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get values from request
        $tripAmount = $request->input('trip_amount');
        $discount = $request->input('discount', 0);
        $advanceReceived = $request->input('advance_received', 0);

        // Basic calculation
        $invoiceValue = $tripAmount - $discount;
        $netPayable = $invoiceValue - $advanceReceived;

        return response()->json([
            'invoice_value' => round($invoiceValue, 2),
            'net_payable' => round($netPayable, 2)
        ]);
    }

    public function store(Request $request)
    {
        try{
            // Validate the request data
            $validatedData = $request->validate([
                'bill_to' => 'required|string|max:30',
                'address' => 'required|string|max:50',
                'gst_no' => 'required|string|max:15',
                'branch' => 'required|integer',
                'invoice_no' => 'required|string|max:10',
                'date' => 'required|date',
                'lr_no' => 'required|string|max:30',
                'truck_no' => 'required|string|max:20',
                'from_to' => 'required|string|max:100',
                'material_parcel' => 'required|string|max:255',
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
                'total_trip_amount' => 'required|numeric',
                'invoice_value' => 'required|numeric',
                'advance_received' => 'required|numeric',
            ],[
                'bill_to.required' => 'Bill to field is required.',
                'address.required' => 'Address field is required.',
                'gst_no.required' => 'GST number is required.',
                'branch.required' => 'Branch field is required.',
                'invoice_no.required' => 'Invoice number is required.',
                'date.required' => 'Date field is required.',
                'truck_no.required' => 'Truck number is required.',
                'from_to.required' => 'From-To field is required.',
                'material_parcel.required' => 'Material/Parcel field is required.',
                'total_weight.required' => 'Total weight is required.',
                'freight_amount.required' => 'Freight amount is required.',
                'halting_charge.required' => 'Halting charge is required.',
                'extra_charge.required' => 'Extra charge is required.',
                'advance.required' => 'Advance is required.',
                'trip_amount.required' => 'Trip amount is required.',
                'hsn_sac.required' => 'HSN/SAC code is required.',
                'remarks.required' => 'Remarks field is required.',
                'discount.required' => 'Discount is required.',
                'total_trip_amount.required' => 'Total trip amount is required.',
                'invoice_value.required' => 'Invoice value is required.',
                'advance_received.required' => 'Advance received is required.',
            ]);
            

            $validatedData['net_payable'] = $validatedData['invoice_value'] - $validatedData['advance_received'];

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

    public function downloadIncoicePDF($invoice_no)
    {
        $data = LR_Generate::where('invoice_no', $invoice_no)->first();
        if (!$data) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        $pdf = Pdf::loadView('pdf', ['data' => $data]);
        return $pdf->download("Invoice_{$invoice_no}.pdf");
    }
}
