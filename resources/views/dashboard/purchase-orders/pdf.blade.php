<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Order - {{ $purchaseOrder->po_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .company-address {
            font-size: 12px;
            margin-bottom: 5px;
        }
        .po-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            text-decoration: underline;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        .info-label {
            width: 150px;
            font-weight: bold;
        }
        .info-value {
            flex: 1;
        }
        .vendor-section, .ship-to-section {
            width: 48%;
            float: left;
            margin-bottom: 20px;
        }
        .ship-to-section {
            float: right;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals {
            width: 300px;
            float: right;
        }
        .totals table {
            margin: 0;
        }
        .totals td {
            border: none;
            padding: 3px 8px;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 200px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">PT. RSI</div>
        <div class="company-address">Jl. Contoh No. 123, Jakarta</div>
        <div class="company-address">Phone: (021) 1234567 | Email: info@rsi.com</div>
    </div>

    <div class="po-title">PURCHASE ORDER</div>

    <!-- PO Information -->
    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Nomor PO:</div>
            <div class="info-value">{{ $purchaseOrder->po_number }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal PO:</div>
            <div class="info-value">{{ $purchaseOrder->formatted_po_date }}</div>
        </div>
        @if($purchaseOrder->ref_number)
        <div class="info-row">
            <div class="info-label">Ref. No:</div>
            <div class="info-value">{{ $purchaseOrder->ref_number }}</div>
        </div>
        @endif
    </div>

    <!-- Vendor and Ship To Information -->
    <div class="vendor-section">
        <h4>Vendor Information:</h4>
        <div class="info-row">
            <div class="info-label">Nama:</div>
            <div class="info-value">{{ $purchaseOrder->vendor_name }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Alamat:</div>
            <div class="info-value">{{ $purchaseOrder->vendor_address }}</div>
        </div>
        @if($purchaseOrder->vendor_email)
        <div class="info-row">
            <div class="info-label">Email:</div>
            <div class="info-value">{{ $purchaseOrder->vendor_email }}</div>
        </div>
        @endif
        @if($purchaseOrder->vendor_contact_person)
        <div class="info-row">
            <div class="info-label">Contact Person:</div>
            <div class="info-value">{{ $purchaseOrder->vendor_contact_person }}</div>
        </div>
        @endif
    </div>

    <div class="ship-to-section">
        <h4>Ship To:</h4>
        <div class="info-row">
            <div class="info-label">Company:</div>
            <div class="info-value">{{ $purchaseOrder->ship_to_company }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Address:</div>
            <div class="info-value">{{ $purchaseOrder->ship_to_address }}</div>
        </div>
        @if($purchaseOrder->attention_to)
        <div class="info-row">
            <div class="info-label">Attention To:</div>
            <div class="info-value">{{ $purchaseOrder->attention_to }}</div>
        </div>
        @endif
        @if($purchaseOrder->attention_name)
        <div class="info-row">
            <div class="info-label">Attention Name:</div>
            <div class="info-value">{{ $purchaseOrder->attention_name }}</div>
        </div>
        @endif
    </div>

    <div class="clear"></div>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Description</th>
                <th width="15%">Part Number</th>
                <th width="8%">Qty</th>
                <th width="8%">UOM</th>
                <th width="15%">Unit Price</th>
                <th width="14%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrder->items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->part_number ?? '-' }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-center">{{ $item->uom }}</td>
                <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals">
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="text-right"><strong>Rp {{ $purchaseOrder->formatted_subtotal }}</strong></td>
            </tr>
            <tr>
                <td><strong>VAT (12%):</strong></td>
                <td class="text-right"><strong>Rp {{ $purchaseOrder->formatted_vat_amount }}</strong></td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td class="text-right"><strong>Rp {{ $purchaseOrder->formatted_total_amount }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="clear"></div>

    <!-- Notes -->
    @if($purchaseOrder->notes)
    <div style="margin-top: 20px;">
        <h4>Notes:</h4>
        <div style="border: 1px solid #ddd; padding: 10px; background-color: #f9f9f9;">
            {{ $purchaseOrder->notes }}
        </div>
    </div>
    @endif

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div><strong>{{ $purchaseOrder->signatoryEmployee->name ?? 'N/A' }}</strong></div>
            <div>{{ $purchaseOrder->signatoryEmployee->position ?? 'N/A' }}</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div><strong>Vendor Signature</strong></div>
            <div>Authorized Signature</div>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top: 50px; text-align: center; font-size: 10px; color: #666;">
        <p>Purchase Order ini dibuat secara elektronik dan berlaku tanpa tanda tangan basah</p>
        <p>Generated on: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html> 