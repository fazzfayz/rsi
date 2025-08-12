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
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            box-sizing: border-box;
            background: #fff;
            width: 100%;
        }
        body {
            width: 100%;
            min-height: 100vh;
            max-width: 100vw;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
            padding-left: 0;
            box-sizing: border-box;
            overflow: hidden;
        }
        .kop-surat {
            text-align: left;
            margin-bottom: 15px;
            padding: 0 2px;
        }
        .kop-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 5px;
        }
        .kop-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .kop-company {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .kop-address {
            font-size: 10pt;
            color: #333;
            margin-bottom: 2px;
        }
        .kop-contact {
            font-size: 9pt;
            color: #333;
        }
        .kop-separator {
            border-top: 2px solid #000;
            margin: 8px 0 18px 0;
        }
        .invoice-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin: 0 0 10px 0;
            letter-spacing: 2px;
        }
        .invoice-info-table {
            width: 100%;
            margin-bottom: 12px;
            font-size: 11pt;
        }
        .invoice-info-table td {
            vertical-align: top;
            padding: 2px 0;
        }
        .invoice-info-label {
            font-weight: bold;
            width: 90px;
            white-space: nowrap;
        }
        .client-info-label {
            font-weight: bold;
            width: 60px;
            white-space: nowrap;
        }
        .items-table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            margin: 12px 0 0 0;
            font-size: 10pt;
            table-layout: fixed;
            overflow: hidden;
        }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 4px 3px;
            font-size: 10pt;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .items-table th {
            background: #f3f3f3;
            text-align: center;
            font-weight: bold;
        }
        .items-table td.center {
            text-align: center;
        }
        .items-table td.right {
            text-align: right;
        }
        .totals-table {
            width: 100%;
            margin-top: 8px;
            font-size: 11pt;
        }
        .totals-table td {
            padding: 2px 4px;
        }
        .totals-table td.label {
            text-align: right;
            font-weight: bold;
            width: 120px;
        }
        .totals-table td.value {
            text-align: right;
            width: 120px;
        }
        .payment-info {
            margin-top: 12px;
            padding: 8px 5px;
            border: none;
            background: none;
            font-size: 9pt;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .payment-info h4 {
            margin: 0 0 6px 0;
            font-weight: bold;
            font-size: 10pt;
        }
        .payment-info p {
            margin: 2px 0;
        }
        .signature-section {
            margin-top: 30px;
            width: 100%;
            max-width: 100%;
            display: flex;
            justify-content: flex-end;
            box-sizing: border-box;
            overflow: hidden;
        }
        .signature-block {
            width: 200px;
            max-width: 200px;
            text-align: center;
            box-sizing: border-box;
            overflow: hidden;
        }
        .signature-space {
            height: 50px;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 100%;
            margin: 0 auto 3px auto;
        }
        .company-footer {
            text-align: center;
            font-size: 9pt;
            color: #666;
            margin-top: 12px;
            padding: 0 5px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .company-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        .footer-separator {
            border-top: 1px solid #000;
            margin: 18px 0 8px 0;
        }
        .attention-section {
            margin-bottom: 4px;
            font-size: 9pt;
        }
        .attention-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat -->
        <div class="kop-surat">
            <img src="{{ public_path('img/rsi.png') }}" alt="Ruang Solusi Internusa Logo" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 5px;">
        </div>

        <!-- Judul Invoice -->
        <div class="invoice-title" style="text-align: left; font-weight: bold; font-size: 16pt; margin: 15px 0;">INVOICE</div>

        <!-- Info Invoice & Client -->
        <table style="width: 100%; max-width: 100%; margin-bottom: 15px; border: none; border-collapse: collapse; overflow: hidden; padding: 0 2px;">
            <tr>
                <!-- Kiri - Info Client -->
                <td style="width: 45%; vertical-align: top; border: none; padding: 0; max-width: 45%; overflow: hidden;">
                    <div style="font-size: 10pt; margin-bottom: 3px; overflow: hidden;"><strong>{{ $invoice->client->name }}</strong></div>
                    <div style="font-size: 10pt; color: #333; margin-left: 15px; max-width: 180px; line-height: 1.3; overflow: hidden;">{{ $invoice->client->address }}</div>
                </td>
                <td style="visibility: hidden;">aku mencintaimu sangat mencintaiku</td>
                <td style="visibility: hidden;">aku mencintaimu sangat mencintaiku</td>
                <!-- Kanan - Info Invoice dengan Invoice No -->
                <td style="width: 55%; vertical-align: top; border: none; padding: 0; max-width: 55%; overflow: hidden;">
                    <table style="width: 100%; border: none; border-collapse: collapse; overflow: hidden;">
                        <tr>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; width: 80px; max-width: 80px; overflow: hidden;"><strong>Invoice No.</strong></td>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; overflow: hidden;">: {{ $invoice->invoice_number }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; max-width: 80px; overflow: hidden;"><strong>Invoice Date</strong></td>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; overflow: hidden;">: {{ $invoice->formatted_invoice_date }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; max-width: 80px; overflow: hidden;"><strong>Due date</strong></td>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; overflow: hidden;">: {{ $invoice->formatted_due_date }}</td>
                        </tr>
                        @if($invoice->vendor_code)
                        <tr>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; max-width: 80px; overflow: hidden;"><strong>Vendor Code.</strong></td>
                            <td style="font-size: 10pt; padding: 1px 0; border: none; overflow: hidden;">: {{ $invoice->vendor_code }}</td>
                        </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <!-- Invoice Info Label -->

        @if($invoice->attention_to)
        <table style="width: 100%; max-width: 100%; margin-bottom: 10px; border: none; border-collapse: collapse; overflow: hidden; padding: 0 2px;">
            <tr>
                <td style="font-size: 10pt; font-weight: bold; padding: 1px 0; border: none; width: 40px; max-width: 40px; overflow: hidden;">Attn</td>
                <td style="font-size: 10pt; padding: 1px 0; border: none; overflow: hidden;">: {{ $invoice->attention_to }}@if($invoice->attention_name) / {{ $invoice->attention_name }}@endif</td>
            </tr>
        </table>
        @endif

                <!-- Tabel Item -->
        <div style="padding: 0 2px;">
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 40%;">Deskripsi</th>
                        <th style="width: 15%;">Jumlah</th>
                        <th style="width: 15%;">Harga Satuan</th>
                        <th style="width: 22%;">Total (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $index => $item)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="center">{{ $item->quantity }}</td>
                        <td class="right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div style="padding: 0 2px;">
            <table style="width: 100%; max-width: 100%; margin-top: 8px; font-size: 10pt; border: none; border-collapse: collapse; table-layout: fixed; overflow: hidden;">
                <tr>
                    <td style="width: 60%; border: none; padding: 2px 4px; max-width: 0; overflow: hidden;"></td>
                    <td style="text-align: right; font-weight: bold; width: 100px; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">Sub Total</td>
                    <td style="text-align: right; width: 100px; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                </tr>
                @if($invoice->include_ppn)
                <tr>
                    <td style="border: none; padding: 2px 4px; max-width: 0; overflow: hidden;"></td>
                    <td style="text-align: right; font-weight: bold; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">PPN 12% x (11/12 x Total)*</td>
                    <td style="text-align: right; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr>
                    <td style="border: none; padding: 2px 4px; max-width: 0; overflow: hidden;"></td>
                    <td style="text-align: right; font-weight: bold; font-size: 12pt; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">Total</td>
                    <td style="text-align: right; font-size: 12pt; border: none; padding: 2px 4px; max-width: 100px; overflow: hidden;">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        @if($invoice->include_ppn)
        <div style="width: 100%; max-width: 100%; font-size: 9pt; margin-top: 4px; font-style: italic; overflow: hidden; padding: 0 2px;">
            * Barang dan jasa selain barang mewah dihitung dari DPP berupa nilai lain yaitu sebesar 11/12 dari nilai impor, harga jual, atau penggantian 12% x (11/12 x Harga Jual, Nilai Impor, atau penggantian)
        </div>
        @endif

        <!-- Payment Information -->
        <div class="payment-info">
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

        <!-- Payment Term -->
        
        <!-- Signature Section -->
        <div class="signature-section" style="text-align: right;">
            <div class="signature-block" style="display: inline-block; text-align: left;">
                <div class="signature-space"></div>
                <div class="signature-line"></div>
                <div style="margin-top: 2px;"><strong>{{ $invoice->signer->name }}</strong></div>
                <div style="margin-top: 2px; font-size: 10pt;">Finance and Accounting Manager</div>
            </div>
        </div>
        
        <div style="width: 100%; max-width: 100%; margin-top: 12px; font-size: 10pt; font-weight: bold; font-style: italic; overflow: hidden; padding: 0 2px;">
            Payment term: Payment is due on presentation of this invoice
        </div>
        <div class="footer-separator"></div>
        <!-- Footer dengan info perusahaan -->
        <div class="company-footer">
            <div class="company-name">PT RUANG SOLUSI INTERNUSA</div>
            <div>
                Bintara Alam Permai, Jl. Alam Utama Raya 1A Blok A No. 6 Bintara Jaya - Bekasi Barat 17136<br>
                Jl. Pondok Kelapa Timur E11 No.2 RT 009/RW 010, Pondok Kelapa, Duren Sawit, Jakarta Timur<br>
                T: +6221-29195365, e: info@ruang-solusi.com www.ruang-solusi.com
            </div>
        </div>
    </div>
</body>
</html>