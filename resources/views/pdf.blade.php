<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; vertical-align: top; }
        .header { text-align: center; font-weight: bold; font-size: 16px; }
        .sub-header { text-align: center; font-size: 12px; }
        .section-title { background: #eee; font-weight: bold; }
        .no-border td { border: none; }
    </style>
</head>
<body>
    <div class="header">Dwarkadhish Logistics</div>
    <div class="sub-header">
        Head Office: 308, Soham Heights, Dashrath, Vadodara, Gujarat-391740.<br>
        Branch Office: 10, Shree Ganesh Complex, Kandla-Rajkot Highway, NH-48, Morbi, Gujarat-363642.
    </div>
    <div class="sub-header" style="display: flex; gap: 80px;">
        GSTIN NO.: 24ESZPD5938M1ZU
        PAN NO.: ESZPD5938M
        DAILY SERVICE: U.P., DELHI, RAJASTHAN, HARYANA & MAHARASHTRA
    </div>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
        <!-- CAUTION Section -->
        <td style="width: 30%; vertical-align: top; margin: 16px; font-weight: bold;">
        CAUTION:<br>
        <small style="font-weight: normal;">
            This consignment will not be detained, delivered, re-routed or re-booked without Consignee bank’s written permission...
        </small>
        </td>
        <!-- Invoice Details -->
        <td style="width: 25%; vertical-align: top; margin: 16px;">
        <div style="margin-bottom: 5px;">INVOICE No.: {{ $data->invoice_no }}</div>
        <div style="margin-bottom: 5px;">VALUE Rs.: {{ $data->value_rs }}</div>
        <div>LORRY No.: {{ $data->lorry_no }}</div>
        </td>
        <!-- NOTICE Section -->
        <td style="width: 45%; vertical-align: top; margin: 16px; font-weight: bold;">
        NOTICE:<br>
        <small style="font-weight: normal;">
            The consignment covered by this set of special lorry receipt form shall be stored at the destination...
        </small>
        </td>
    </tr>
    </table>
    <br>
    <table>
        <tr>
            <td><strong>C.N. No:</strong> {{$data->cnn_no}}</td><br>
            <td><strong>Delivery At:</strong> {{$data->delivery_at}}</td><br>
            <td><strong>Date:</strong> {{$data->date}}</td><br>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td><strong>Consignor:</strong> {{$data->consignor}}<br>
                <br><strong>GSTIN No.:</strong> {{$data->consignor_gstin_no}}
                <br><strong>E-way Bill No.:</strong> {{$data->consignor_eway_bill_no}}
            </td>
            <div></div>
            <td colspan="2">AT OWNER’S RISK<br>INSURANCE:<br>He has INSURED / NOT INSURED...
            <br>Company: {{$data->insurance_company_name}}
            <br>Policy No: {{$data->policy_no}}
            <br>Amount: {{$data->amount_rs}}
            Risk Rs.: {{$data->risk_rs}}</td>
            <div></div>
            <td><strong>Consignee:</strong> {{$data->consignee}}<br>
                <br><strong>GSTIN No.:</strong> {{$data->consignee_gstin_no}}
                <br><strong>E-way Bill No.:</strong> {{$data->consignee_eway_bill_no}}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td><strong>From:</strong> {{$data->from}}</td><br>
            <td><strong>To:</strong> {{$data->to}}</td><br>
        </tr>
    </table>
    <br>
    <table style="width: 100%; border: 1px solid #000; font-size: 12px;">
        <thead style="background-color: #f5f5f5;">
            <tr>
                <th>Packages</th>
                <th>Destination (Said to Contain)</th>
                <th>Actual Wt. (Kg.)</th>
                <th>Rate Per MT</th>
                <th colspan="2">PAID / TO PAY</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="7">{{ $data['packages'] }}</td>
                <td rowspan="6">{{ $data['destination'] }}</td>
                <td rowspan="2">{{ $data['actual_weight'] }}</td>
                <td>{{ $data['rate_per_mt'] }}</td>
                <td colspan="2"></td>
                <td>{{$data['remarks']}}</td>
            </tr>
            <tr>
                <td>B.C.</td>
                <td colspan="2">{{ $data['bc'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="2">Rate Per MT</td>
                <td>SGST %</td>
                <td colspan="2">{{ $data['sgst'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td>CGST %</td>
                <td colspan="2">{{ $data['cgst'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="2"></td>
                <td>IGST %</td>
                <td colspan="2">{{ $data['igst'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td>G.C.</td>
                <td colspan="2">{{ $data['gc'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Not Responsible for Breakage, Damage & Leakage.</td>
                <td>O/R</td>
                <td><strong>Grand Total</strong></td>
                <td>{{ $data['grand_total'] }}</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>
    <div>Bank Details: SBI A/c No.: 42819194845 / IFSC CODE: SBIN0015242 / BRANCH: DASHRATH - VADODARA</div>
    <br>
    <div style="text-align: right;">For, DWARKADHISH LOGISTICS</div>
</body>
</html>
