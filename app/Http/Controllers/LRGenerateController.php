<?php

namespace App\Http\Controllers;

use App\Models\LR_Generate;
use Illuminate\Http\Request;

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
                'invoice_no' => 'required|integer',
                'value_rs' => 'required|integer',
                'lorry_no' => 'required|integer',
                'cnn_no' => 'required|integer',
                'delivery_at' => 'required|string|max:30',
                'date' => 'required|date',
                'consignor_gstin_no' => 'required|string|max:30',
                'consignor_eway_bill_no' => 'required|string|max:30',
                'consignee_gstin_no' => 'required|string|max:30',
                'consignee_eway_bill_no' => 'required|string|max:30',
                'from' => 'required|string|max:30',
                'to' => 'required|string|max:30',
                'insurance_company_name' => 'required|string|max:20',
                'policy_no' => 'required|integer',
                'amount_rs' => 'required|numeric',
                'risk_rs' => 'required|numeric',
                'packages' => 'required|string|max:30',
                'destination' => 'required|string|max:30',
                'actual_weight' => 'required|numeric',
                'rate_per_mt' => 'required|numeric',
                'bc' => 'required|numeric',
                'sgst' => 'required|numeric',
                'cgst' => 'required|numeric',
                'igst' => 'required|numeric',
                'gc' => 'required|numeric',
                'grand_total' => 'required|numeric',
            ], [
                'invoice_no.required' => 'Invoice number is required.',
                'invoice_no.integer' => 'Invoice number must be a valid integer.',
                'value_rs.required' => 'Value is required.',
                'value_rs.integer' => 'Value must be a valid integer.',
                'lorry_no.required' => 'Lorry number is required.',
                'lorry_no.integer' => 'Lorry number must be a valid integer.',
                'cnn_no.required' => 'CNN number is required.',
                'cnn_no.integer' => 'CNN number must be a valid integer.',
                'delivery_at.required' => 'Delivery location is required.',
                'delivery_at.max' => 'Delivery location must not exceed 30 characters.',
                'date.required' => 'Date is required.',
                'date.date' => 'Date must be a valid date format.',
                'consignor_gstin_no.required' => 'Consignor GSTIN number is required.',
                'consignor_gstin_no.max' => 'Consignor GSTIN number must not exceed 30 characters.',
                'consignor_eway_bill_no.required' => 'Consignor E-way bill number is required.',
                'consignor_eway_bill_no.max' => 'Consignor E-way bill number must not exceed 30 characters.',
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
                'packages.required' => 'Package information is required.',
                'packages.max' => 'Package information must not exceed 30 characters.',
                'destination.required' => 'Destination is required.',
                'destination.max' => 'Destination must not exceed 30 characters.',
                'actual_weight.required' => 'Actual weight is required.',
                'actual_weight.numeric' => 'Actual weight must be a valid number.',
                'rate_per_mt.required' => 'Rate per MT is required.',
                'rate_per_mt.numeric' => 'Rate per MT must be a valid number.',
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

            $lrGenerate = LR_Generate::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Data inserted successfully',
                'data' => $lrGenerate
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}