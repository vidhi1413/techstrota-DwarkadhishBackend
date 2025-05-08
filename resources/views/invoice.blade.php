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
        .logo { width: 100px;}
        .color { color:slategrey}
        .items-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15); /* Light 3D effect */
            margin-top: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ccc;
            padding: 6px;
            background-color: #fff;
        }

        .items-table thead {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .items-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .items-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h5 style="color: red; text-align:center">SHREE GANESHAY NAMAH</h5>
    <h1 style="text-align: center;">DWARKADHISH LOGISTICS</h1>
    <table style="border: none;">
        <tr style="border: none;">
            <td style="border: none;"><img src="{{ public_path('images/logo.png') }}" class="logo" alt="Company Logo" style="display: block; margin: 0 auto;"></td>
            <td style="border: none;">Head Office: 308, Soham Heights, Dashrath, Vadodara, Gujarat-391740.<br>
                Branch Office: 10, Shree Ganesh Complex, Kandla-Rajkot Highway, NH-48, Morbi, Gujarat-363642.
            </td>
            <td style="border: none;"><strong>Mobile No:</strong> 8200167319<br>
                <strong>Email:</strong> dwarkadhishlogistic2504@gmail.com
            </td>
        </tr>
    </table>
    <p style="text-align: center;">
        GSTIN NO: <span style="color: #666;">24ESZPD5938M1ZU</span>&nbsp;&nbsp;&nbsp;&nbsp;
        PAN NO: <span style="color: #666;">ESZPD5938M</span>&nbsp;&nbsp;&nbsp;&nbsp;
        Transport Reg: <span style="color: #666;">9662332719</span>
    </p>

    <br>
    <table class="items-table">
        <tr>
            <td><strong>Bill To: </strong> {{ $data->bill_to }}<br>
                <strong>Address: </strong> {{ $data->address }}<br>
                <strong>GST No: </strong> {{ $data->gst_no }}</td>
            <td align="center">
                <strong>Date:</strong> {{ $data->date }}<br>
                <strong>Invoice Number:</strong> {{ $data->invoice_no }}<br>
                <strong>Branch:</strong> {{ $data->branch }}
            </td>
        </tr>
    </table>
    <table class="items-table">
        <thead>
            <tr>
                <th style="background-color: #dceeff; border-top-left-radius: 8px; border: none">LR/GR/Bilty Number</th>
                <th style="background-color: #dceeff; border: none">Truck Number</th>
                <th style="background-color: #dceeff; border: none">From - To</th>
                <th style="background-color: #dceeff; border: none">Material / Parcel Details</th>
                <th style="background-color: #dceeff; border: none">Total Weight</th>
                <th style="background-color: #dceeff; border: none">Freight Amount</th>
                <th style="background-color: #dceeff; border: none">Halting Charge</th>
                <th style="background-color: #dceeff; border: none">Extra Charge</th>
                <th style="background-color: #dceeff; border: none">Advance</th>
                <th style="background-color: #dceeff; border-top-right-radius: 8px; border: none">Trip Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->lr_no}}</td>
                <td>{{$data->truck_no}}</td>
                <td>{{$data->from_to}}</td>
                <td>{{$data->material_parcel}}</td>
                <td>{{$data->total_weight}}</td>
                <td>{{$data->freight_amount}}</td>
                <td>{{$data->halting_charge}}</td>
                <td>{{$data->extra_charge}}</td>
                <td>{{$data->advance}}</td>
                <td>{{$data->trip_amount}}</td>
            </tr>
            <tr>
                <td colspan="5"><strong>HSN / SAC:<strong> {{$data->hsn_sac}}</td>
                <td colspan="3"><strong>Sub Total:</strong> </td>
                <td colspan="2" align="right">{{ number_format($data->sub_total, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="2">Remarks: {{$data->remarks}}</td>
                <td colspan="3"><strong>Discount:</strong></td>
                <td colspan="2" align="right">{{ number_format($data->discount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total Trip Amount:</strong></td>
                <td colspan="2" align="right">{{ number_format($data->total_trip_amount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="3">{{$data->amount_in_words}}</td>
                <td colspan="3"><strong>INVOICE VALUE:</strong></td>
                <td colspan="2" align="right">{{ number_format($data->invoice_value, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Advance Received:</strong></td>
                <td colspan="2" align="right">{{ number_format($data->advance_received, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Net Payable:</strong></td>
                <td colspan="2" align="right">{{ number_format($data->net_payable, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="items-table">
        <tr>
            <td>1. All disputes subject to our MORBI, Gujarat jurisdiction.<br>
                2. Penalty/ Interest will be charged if is	not	paid on presentation<br>
                3. GST will be paid by Consignor / Consignee / Transporter<br>
                4. GST exempt is given on hire to GOODS TRANSPORT COMPANY<br>
            </td>
            <td align="center">
                Bank Name: State Bank of India,<br>
                Account No: 42819194845,<br>
                IFSC Code: SBI0015242,<br>
            </td>
        </tr>
    </table>
</body>
</html>