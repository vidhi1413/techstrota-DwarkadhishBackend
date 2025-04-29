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
        try{
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
            ]);
    
            $lrGenerate = LR_Generate::create($validatedData);
    
            return response()->json([
                'status' => true,
                'message' => 'Data inserted successfully',
                'data' => $lrGenerate
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
