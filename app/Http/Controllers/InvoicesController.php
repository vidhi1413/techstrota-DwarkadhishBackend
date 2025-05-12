<?php
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NumberToWords\NumberToWords;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\InvoiceItem;
use App\Models\Invoices;

    class InvoicesController extends Controller
    {
        public function index()
        {
            return Invoices::all();
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
                    'hsn_sac' => 'required|string|max:20',
                    'remarks' => 'required|string',
                    'sub_total' => 'required|numeric',
                    'discount' => 'required|numeric',
                    'total_trip_amount' => 'required|numeric',
                    'invoice_value' => 'required|numeric',
                    'advance_received' => 'required|numeric',
                    'items' => 'required|array|min:1',
                    'items.*.lr_no' => 'required|string|max:30',
                    'items.*.truck_no' => 'required|string|max:20',
                    'items.*.from_to' => 'required|string|max:100',
                    'items.*.material_parcel' => 'required|string|max:255',
                    'items.*.total_weight' => 'required|numeric',
                    'items.*.freight_amount' => 'required|numeric',
                    'items.*.halting_charge' => 'required|numeric',
                    'items.*.extra_charge' => 'required|numeric',
                    'items.*.advance' => 'required|numeric',
                    'items.*.trip_amount' => 'required|numeric',
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
                    'hsn_sac.required' => 'HSN/SAC code is required.',
                    'remarks.required' => 'Remarks field is required.',
                    'discount.required' => 'Discount is required.',
                ]);
                $validatedData['date'] = \Carbon\Carbon::parse($validatedData['date'])->setTimeFromTimeString(now()->format('H:i:s'));

                $validatedData['net_payable'] = $validatedData['invoice_value'] - $validatedData['advance_received'];

                // Create a new invoice
                $invoice = Invoices::create($validatedData);

                // Save each item with trip_amount and invoice_id
                foreach ($validatedData['items'] as $item) {
                    $item['invoice_id'] = $invoice->id;
                    InvoiceItem::create($item);
                }

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

        function convertNumberToWords($amount) {
            $numberToWords = new NumberToWords();
            // Create the number transformer for English
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            return strtoupper($numberTransformer->toWords($amount)) . ' ONLY';
        }

        public function downloadInvoicePDF($invoice_no)
        {
            $data = Invoices::with('items')->where('invoice_no', $invoice_no)->first();
            if (!$data) {
                return response()->json(['error' => 'Invoice not found'], 404);
            }
            
            $data->amount_in_words = $this->convertNumberToWords($data->net_payable);
            $pdf = Pdf::loadView('invoice', ['data' => $data]);
            return $pdf->download("Invoice_{$invoice_no}.pdf");
        }
    }
