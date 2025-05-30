<?php

namespace App\Http\Controllers;

use App\Models\LR_Generate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LRGenerateController extends Controller
{
    public function index()
    {
        return LR_Generate::all();
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'value_rs' => 'required|integer',
                'lorry_no' => 'required|string|max:30',
                'delivery_at' => 'required|string|max:30',
                'date' => 'required|date',
                'consignor' => 'required|string|max:30',
                'consignor_gstin_no' => 'required|string|max:30',
                'consignor_eway_bill_no' => 'required|string|max:30',
                'consignee' => 'required|string|max:30',
                'consignee_gstin_no' => 'required|string|max:30',
                'consignee_eway_bill_no' => 'required|string|max:30',
                'from' => 'required|string|max:30',
                'to' => 'required|string|max:30',
                'insurance_company_name' => 'required|string|max:20',
                'policy_no' => 'required|integer',
                'amount_rs' => 'required|numeric',
                'risk_rs' => 'required|numeric',
                'gst_payer' => 'required|string|max:30',
                'packages' => 'required|string|max:30',
                'destination' => 'required|string|max:30',
                'actual_weight' => 'required|numeric',
                'rate_per_mt' => 'required|numeric',
                'remarks' => 'required|string|max:30',
                'bc' => 'required|numeric',
                'sgst' => 'required|numeric',
                'cgst' => 'required|numeric',
                'igst' => 'required|numeric',
                'gc' => 'required|numeric',
                'grand_total' => 'required|numeric',
            ], [
                'value_rs.required' => 'Value is required.',
                'value_rs.integer' => 'Value must be a valid integer.',
                'lorry_no.required' => 'Lorry number is required.',
                'lorry_no.integer' => 'Lorry number must be a valid integer.',
                'delivery_at.required' => 'Delivery location is required.',
                'delivery_at.max' => 'Delivery location must not exceed 30 characters.',
                'date.required' => 'Date is required.',
                'date.date' => 'Date must be a valid date format.',
                'consignor.required' => 'Consignor name is required.',
                'consignor.max' => 'Consignor name must not exceed 30 characters.',
                'consignor_gstin_no.required' => 'Consignor GSTIN number is required.',
                'consignor_gstin_no.max' => 'Consignor GSTIN number must not exceed 30 characters.',
                'consignor_eway_bill_no.required' => 'Consignor E-way bill number is required.',
                'consignor_eway_bill_no.max' => 'Consignor E-way bill number must not exceed 30 characters.',
                'consignee.required' => 'Consignee name is required.',
                'consignee.max' => 'Consignee name must not exceed 30 characters.',
                'consignee_gstin_no.required' => 'Consignee GSTIN number is required.',
                'consignee_gstin_no.max' => 'Consignee GSTIN number must not exceed 30 characters.',
                'consignee_eway_bill_no.required' => 'Consignee E-way bill number is required.',
                'consignee_eway_bill_no.max' => 'Consignee E-way bill number must not exceed 30 characters.',
                'from.required' => 'From location is required.',
                'from.max' => 'From location must not exceed 30 characters.',
                'to.required' => 'To location is required.',
                'to.max' => 'To location must not exceed 30 characters.',
                'insurance_company_name.required' => 'Insurance company name is required.',
                'insurance_company_name.max' => 'Insurance company name must not exceed 20 characters.',
                'policy_no.required' => 'Policy number is required.',
                'policy_no.integer' => 'Policy number must be a valid integer.',
                'amount_rs.required' => 'Amount is required.',
                'amount_rs.numeric' => 'Amount must be a valid number.',
                'risk_rs.required' => 'Risk amount is required.',
                'risk_rs.numeric' => 'Risk amount must be a valid number.',
                'gst_payer.required' => 'GST payer is required.',
                'gst_payer.max' => 'GST payer must not exceed 30 characters.',
                'packages.required' => 'Package information is required.',
                'packages.max' => 'Package information must not exceed 30 characters.',
                'destination.required' => 'Destination is required.',
                'destination.max' => 'Destination must not exceed 30 characters.',
                'actual_weight.required' => 'Actual weight is required.',
                'actual_weight.numeric' => 'Actual weight must be a valid number.',
                'rate_per_mt.required' => 'Rate per MT is required.',
                'rate_per_mt.numeric' => 'Rate per MT must be a valid number.',
                'remarks.required' => 'Remarks are required.',
                'remarks.max' => 'Remarks must not exceed 30 characters.',
                'bc.required' => 'BC is required.',
                'bc.numeric' => 'BC must be a valid number.',
                'sgst.required' => 'SGST is required.',
                'sgst.numeric' => 'SGST must be a valid number.',
                'cgst.required' => 'CGST is required.',
                'cgst.numeric' => 'CGST must be a valid number.',
                'igst.required' => 'IGST is required.',
                'igst.numeric' => 'IGST must be a valid number.',
                'gc.required' => 'GC is required.',
                'gc.numeric' => 'GC must be a valid number.',
                'grand_total.required' => 'Grand total is required.',
                'grand_total.numeric' => 'Grand total must be a valid number.',
            ]);

            $validatedData['date'] = \Carbon\Carbon::parse($validatedData['date'])->setTimeFromTimeString(now()->format('H:i:s'));

            $latestLR = LR_Generate::orderBy('lr_generate_no', 'desc')->first();
            // Generate next invoice_no
            if ($latestLR && preg_match('/^DKI(\d+)$/', $latestLR->invoice_no, $matches)) {
                $nextInvoiceNumber = intval($matches[1]) + 1;
                $validatedData['invoice_no'] = 'DKI' . str_pad($nextInvoiceNumber, 4, '0', STR_PAD_LEFT);
            } else {
                $validatedData['invoice_no'] = 'DKI0001';
            }

            // Generate next cnn_no
            if ($latestLR && preg_match('/^DKC(\d+)$/', $latestLR->cnn_no, $matches)) {
                $nextCNNNumber = intval($matches[1]) + 1;
                $validatedData['cnn_no'] = 'DKC' . str_pad($nextCNNNumber, 3, '0', STR_PAD_LEFT);
            } else {
                $validatedData['cnn_no'] = 'DKC001';
            }

            $lrGenerate = LR_Generate::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Data inserted successfully',
                'data' => $lrGenerate
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getNextNumbers()
    {
        $latestLR = LR_Generate::orderBy('lr_generate_no', 'desc')->first();

        // Generate next invoice_no
        if ($latestLR && preg_match('/^DKI(\d+)$/', $latestLR->invoice_no, $matches)) {
            $nextInvoiceNumber = intval($matches[1]) + 1;
            $invoice_no = 'DKI' . str_pad($nextInvoiceNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $invoice_no = 'DKI0001';
        }

        // Generate next cnn_no
        if ($latestLR && preg_match('/^DKC(\d+)$/', $latestLR->cnn_no, $matches)) {
            $nextCNNNumber = intval($matches[1]) + 1;
            $cnn_no = 'DKC' . str_pad($nextCNNNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $cnn_no = 'DKC001';
        }

        return response()->json([
            'invoice_no' => $invoice_no,
            'cnn_no' => $cnn_no
        ]);
    }
    
    public function downloadPDF($invoice_no)
    {
        $data = LR_Generate::where('invoice_no', $invoice_no)->first();
        if (!$data) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }
        $pdf = Pdf::loadView('lrgenerate', ['data' => $data]);
        return $pdf->download("LR_{$invoice_no}.pdf");
    }

    public function getLRDetailsByInvoice($lr_no)
    {
        $lr = LR_Generate::where('lr_generate_no', $lr_no)->first();

        if (!$lr) {
            return response()->json(['error' => 'No LR record found'], 404);
        }

        return response()->json([
            'truck_no' => $lr->lorry_no,
            'from_to' => $lr->from . ' - ' . $lr->to,
            'total_weight' => $lr->actual_weight,
        ]);
    }
}