<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .header-section {
            margin-bottom: 20px;
        }
        .logo {
            height: 90px;
            margin-bottom: 10px;
        }
        .invoice-title {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .client-info {
            margin-bottom: 8px;
        }
        .client-name {
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 4px;
        }
        .client-address {
            font-size: 10pt;
            line-height: 1.4;
            margin-bottom: 4px;
        }
        .attention-line {
            font-size: 10pt;
            margin-bottom: 4px;
        }
        .attention-name {
            font-weight: bold;
        }
        .header-row {
            width: 100%;
            border: none;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .header-row td {
            vertical-align: top;
            border: none;
            padding: 0;
        }
        .header-row .client-cell {
            width: 50%;
            padding-right: 24px;
        }
        .header-row .invoice-details-cell {
            width: 50%;
            font-size: 10pt;
        }
        .header-row .invoice-details-cell table {
            border: none;
            border-collapse: collapse;
        }
        .header-row .invoice-details-cell td {
            padding: 2px 0;
            border: none;
        }
        .header-row .invoice-details-cell td:first-child {
            font-weight: bold;
            padding-right: 8px;
        }
        .table-with-note {
            margin: 15px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 8px 0;
            font-size: 10pt;
            border: 1px solid #000;
        }
        .items-table th,
        .items-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: middle;
        }
        .items-table th {
            background: #fff;
            font-weight: bold;
        }
        .items-table th.th-no {
            width: 8%;
            text-align: left;
        }
        .items-table th.th-desc {
            width: 72%;
            text-align: center;
        }
        .items-table th.th-total {
            width: 20%;
            text-align: right;
            line-height: 1.3;
        }
        .items-table td.col-no {
            width: 8%;
            text-align: left;
        }
        .items-table td.col-desc {
            width: 72%;
            text-align: left;
        }
        .items-table td.col-total {
            width: 20%;
            text-align: right;
        }
        .summary-row td {
            border: 1px solid #000;
            padding: 8px 10px;
        }
        .summary-row td:first-child {
            text-align: center;
            font-weight: bold;
        }
        .summary-row td:last-child {
            text-align: right;
        }
        .total-row td {
            font-weight: bold;
        }
        .total-row td:last-child {
            font-weight: bold;
            font-size: 11pt;
        }
        .ppn-note {
            font-size: 9pt;
            font-style: italic;
            margin-top: 4px;
            margin-bottom: 15px;
        }
        .invoice-notes {
            font-size: 9pt;
            margin-top: 4px;
            margin-bottom: 10px;
        }
        .invoice-notes .label {
            font-weight: bold;
        }
        .payment-section {
            margin-top: 20px;
            font-size: 9pt;
        }
        .payment-section h4 {
            font-size: 10pt;
            font-weight: bold;
            margin: 0 0 8px 0;
        }
        .payment-section p {
            margin: 2px 0;
        }
        .payment-section strong {
            font-weight: bold;
        }
        .yellow-line {
            border-top: 2px solid #FFD700;
            margin: 15px 0;
        }
        .payment-term-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 20px;
            margin-bottom: 15px;
        }
        .payment-term {
            font-style: italic;
            font-size: 10pt;
        }
        .signature-block {
            text-align: right;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
        }
        .signature-title {
            font-size: 10pt;
        }
        .footer-section {
            text-align: center;
            font-size: 9pt;
            margin-top: 15px;
        }
        .footer-company {
            font-weight: bold;
            margin-bottom: 4px;
        }
        .footer-address {
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="header-section">
        <!-- Logo -->
        <img src="{{ public_path('img/rsi.png') }}" alt="RSI Logo" class="logo">
        
        <!-- Invoice Title -->
        <div class="invoice-title">INVOICE</div>
        
        <!-- Satu baris: kiri = client (PT PAYUNG... + alamat + Attn), kanan = Invoice No. s/d Vendor Code (sejajar di atas) -->
        <table class="header-row" style="width: 100%; border: none; border-collapse: collapse;">
            <tr>
                <td style="width: 55%; vertical-align: top; padding: 0; padding-right: 24px; border: none;">
                    <div style="font-weight: bold; font-size: 12pt; margin-bottom: 4px;">{{ $invoice->client->name }}</div>
                    <div style="font-size: 10pt; line-height: 1.4; margin-bottom: 4px;">{{ $invoice->client->address }}</div>
                    @if($invoice->attention_to)
                    <!-- Attn moved above table as requested -->
                    @if($invoice->attention_to)
                    <div style="font-size: 10pt; margin-bottom: 15px;">
                        Attn : <strong>{{ $invoice->attention_to }}</strong>@if($invoice->attention_name) / {{ $invoice->attention_name }}@endif
                    </div>
                    @endif
                    @endif
                </td>
                <td style="width: 35%; vertical-align: top; padding: 0; padding-left: 24px; font-size: 10pt; line-height: 1.4; text-align: left;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 80px; vertical-align: top; text-align: left; padding: 0; padding-bottom: 8px;">Invoice No</td>
                            <td style="width: 20px; text-align: left; padding: 0; padding-bottom: 8px;">:</td>
                            <td style="text-align: left; padding: 0; padding-bottom: 8px;">{{ $invoice->invoice_number }}</td>
                        </tr>
                        <tr>
                            <td style="width: 80px; vertical-align: top; text-align: left; padding: 0; padding-bottom: 8px;">Invoice Date</td>
                            <td style="width: 20px; text-align: left; padding: 0; padding-bottom: 8px;">:</td>
                            <td style="text-align: left; padding: 0; padding-bottom: 8px;">{{ $invoice->invoice_date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 80px; vertical-align: top; text-align: left; padding: 0; padding-bottom: 8px;">Due date</td>
                            <td style="width: 20px; text-align: left; padding: 0; padding-bottom: 8px;">:</td>
                            <td style="text-align: left; padding: 0; padding-bottom: 8px;">{{ $invoice->due_date->format('d/m/Y') }}</td>
                        </tr>
                        @if($invoice->vendor_code)
                        <tr>
                            <td style="width: 80px; vertical-align: top; text-align: left; padding: 0;">Vendor Code</td>
                            <td style="width: 20px; text-align: left; padding: 0; padding-bottom: 8px;">:</td>
                            <td style="text-align: left; padding: 0;">{{ $invoice->vendor_code }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="width: 80px; vertical-align: top; text-align: left; padding: 0;">PO Ref Number</td>
                            <td style="width: 20px; text-align: left; padding: 0; padding-bottom: 8px;">:</td>
                            <td style="text-align: left; padding: 0;">{{ $invoice->po_ref_number ?? '' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- Items Table (sesuai foto: No | Description | Total IDR) -->
    <div class="table-with-note">
        <table class="items-table">
            <thead>
                <tr>
                    <th class="th-no" style="text-align: center;">No</th>
                    <th class="th-desc" style="text-align: center;">Description</th>
                    <th class="th-total" style="text-align: center;">Total<br>IDR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $index => $item)
                <tr>
                    <td class="col-no" style="text-align: center;">{{ $index + 1 }}</td>
                    <td class="col-desc" style="text-align: left;">{{ $item->description }}</td>
                    <td class="col-total" style="text-align: right;">{{ number_format($item->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach

                <!-- Summary Rows: label rata kiri sejajar (Sub Total, PPN, Total), value kanan -->
                <tr class="summary-row">
                    <td colspan="2" style="text-align: right; font-weight: bold;padding-right: 118px;">Sub Total</td>
                    <td class="col-total" style="text-align: right;">{{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr class="summary-row">
                    <td colspan="2" style="text-align: right; font-weight: bold;">PPN 12% x (11/12 X Total)*</td>
                    <td class="col-total" style="text-align: right;">{{ number_format($invoice->include_ppn ? $invoice->ppn_amount : 0, 0, ',', '.') }}</td>
                </tr>
                <tr class="summary-row total-row">
                    <td colspan="2" style="text-align: right; font-weight: bold; padding-right: 148px;">Total</td>
                    <td class="col-total" style="text-align: right;"><strong>{{ number_format($invoice->total_amount, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        @if(!empty($invoice->notes))
        <div class="invoice-notes">
            <span class="label">Catatan:</span>
            {!! nl2br(e($invoice->notes)) !!}
        </div>
        @endif

        @if($invoice->include_ppn)
        <div class="ppn-note">
            * Barang dan jasa selain barang mewah dihitung dari DPP berupa nilai lain yaitu sebesar 11/12 dari nilai impor, harga jual, atau penggantian 12% x (11/12 x Harga Jual, Nilai Impor, atau penggantian)
        </div>
        @endif
    </div>

    <!-- Wrapper for sticky bottom -->
    <div style="position: fixed; left: 0; right: 0; bottom: 0; width: 100%;">
        <!-- Payment Information -->
        <div class="payment-section">
            <h4>Please ensure that our invoice reference number is mentioned in your bank transfer letter and make all payments to:</h4>
            <p><strong>PT RUANG SOLUSI INTERNUSA</strong></p>
            <p>NPWP: 60.963.097.5-427.000</p>
            <p><strong>Bank Mandiri KCP. Bekasi - Bintara</strong></p>
            <p>Acc. No. : 167.000.490.715.9</p>
            <p>Swift Code : BMRIIDJA</p>
            <p><strong>Bank Central Asia KCU. Kalimalang</strong></p>
            <p>Acc. No. : 230.601.667.6</p>
            <p>Swift Code : CENAIDJA</p>
        </div>

        <!-- Yellow Line -->
      
        

        <!-- Payment Term and Signature -->
        <div class="payment-term-section">
            <div class="payment-term">
                Payment term: <em>Payment is due on presentation of this invoice</em>
            </div>
            <div class="signature-block">
                <div class="signature-name">{{ $invoice->signer->name }}</div>
                <div class="signature-title">Finance and Accounting Manager</div>
            </div>
        </div>

        <!-- Yellow Line -->
        <div class="yellow-line"></div>

        <!-- Footer -->
        <div class="footer-section">
            <div class="footer-company">PT RUANG SOLUSI INTERNUSA</div>
            <div class="footer-address">
                Bintara Alam Permai, Jl. Alam Utama Raya 1A Blok A No. 6 Bintara Jaya - Bekasi Barat 17136<br>
                Jl. Pondok Kelapa Timur E11 No.2 RT 009/RW 010, Pondok Kelapa, Duren Sawit, Jakarta Timur<br>
                T: +6221-29195365, e: info@ruang-solusi.com<br>
                www.ruang-solusi.com
            </div>
        </div>
    </div>
    <!-- End of sticky bottom wrapper -->
</body>
</html>
