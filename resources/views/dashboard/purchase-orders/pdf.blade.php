<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Purchase Order - {{ $purchaseOrder->po_number ?? 'PO' }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }

        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }

        table.items-main {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }

        table.items-main th,
        table.items-main td {
            border: 1px solid #000;
            padding: 6px 8px;
            overflow: hidden;
            vertical-align: top;
        }

        table.items-main th {
            background: #e9ecef;
            font-weight: bold;
        }

        table.items-main .col-no { width: 4%; }
        table.items-main .col-desc { width: 38%; }
        table.items-main .col-part { width: 10%; }
        table.items-main .col-qty { width: 8%; }
        table.items-main .col-uom { width: 10%; }
        table.items-main .col-unit { width: 15%; }
        table.items-main .col-total { width: 15%; }

        /* Part Number sering panjang: kecilkan font + izinkan wrap */
        table.items-main th.col-part,
        table.items-main td.col-part {
            font-size: 10px;
            line-height: 1.15;
            padding: 4px 6px;
            word-break: break-all;
            white-space: normal;
        }

        table.summary-table {
            width: 240px;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        table.summary-table td {
            border: 1px solid #000;
            padding: 6px 8px;
        }

        /* Tanda tangan tetap di paling bawah kanan kertas, tidak bergerak saat tabel/item bertambah */
        .signature-fixed {
            position: fixed;
            bottom: 40px;
            right: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    @php
        $fmt = function ($n) { return number_format((float) ($n ?? 0), 0, ',', '.'); };
        $items = $purchaseOrder->items ?? collect();
        $poDateFormatted = $purchaseOrder->po_date ? $purchaseOrder->po_date->format('d-M-Y') : '';
    @endphp

    <!-- HEADER: Baris 1 = Logo kiri; Baris 2 = Purchase Order + No (tengah). Logo tetap di kiri, di atas tulisan PO -->
    <table style="width: 100%; border-collapse: collapse; border: none; margin-bottom: 18px;">
        <tr>
            <td style="width: 28%; vertical-align: top; padding-right: 16px;">
                <img src="{{ public_path('img/rsi.png') }}" alt="Logo" style="height: 110px; display: block;">
            </td>
            <td style="width: 44%; vertical-align: top;"></td>
            <td style="width: 28%; vertical-align: top;"></td>
        </tr>
        <tr>
            <td style="width: 28%; vertical-align: top; padding-right: 16px;"></td>
            <td style="width: 44%; vertical-align: top; text-align: center; padding-top: 0;">
                <div style="font-size: 18px; font-weight: bold; text-transform: uppercase;">Purchase Order</div>
                <div style="font-size: 12px; margin-top: 4px;">No. {{ $purchaseOrder->po_number ?? '—' }}</div>
            </td>
            <td style="width: 28%; vertical-align: top;"></td>
        </tr>
    </table>

    <!-- MID: Vendor (kiri) | Date & Ship to (kanan) - sejajar satu baris -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 22px; font-size: 11px;">
        <tr>
            <td style="width: 50%; vertical-align: top; padding-right: 24px;">
                <div style="margin-bottom: 10px; font-weight: bold;">Vendor :</div>
                <table style="border: none; border-collapse: collapse; font-size: 11px;">
                    <colgroup><col style="width: 120px;"><col></colgroup>
                    <tr>
                        <td style="padding: 4px 0; border: none; white-space: nowrap; vertical-align: top;">
                            <span style="display: inline-block; width: 80px; text-align: left;">Company name</span><span style="display: inline-block; width: 12px; text-align: left;">:</span>
                        </td>
                        <td style="padding: 4px 0; border: none; vertical-align: top;"><strong>{{ $purchaseOrder->vendor_name ?: '—' }}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; border: none; white-space: nowrap; vertical-align: top;">
                            <span style="display: inline-block; width: 80px; text-align: left;">Address</span><span style="display: inline-block; width: 12px; text-align: left;">:</span>
                        </td>
                        <td style="padding: 4px 0; border: none; vertical-align: top; line-height: 1.5;">
                            @php
                                $addr = $purchaseOrder->vendor_address ?: '—';
                                $addrLines = array_filter(array_map('trim', explode("\n", str_replace(["\r\n", "\r"], "\n", $addr))));
                            @endphp
                            @if(!empty($addrLines))
                                @foreach($addrLines as $line)
                                    <div style="margin-bottom: 2px;">
                                        @if(preg_match('/^www\./i', $line) || preg_match('/^https?:\/\//i', $line))
                                            <span style="color: #0066cc; text-decoration: underline;">{{ $line }}</span>
                                        @else
                                            {{ $line }}
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                {{ $addr }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; border: none; white-space: nowrap; vertical-align: top;">
                            <span style="display: inline-block; width: 80px; text-align: left;">Email</span><span style="display: inline-block; width: 12px; text-align: left;">:</span>
                        </td>
                        <td style="padding: 4px 0; border: none; vertical-align: top;">
                            @if(!empty($purchaseOrder->vendor_email))
                                <span style="color: #0066cc; text-decoration: underline;">{{ $purchaseOrder->vendor_email }}</span>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; border: none; white-space: nowrap; vertical-align: top;">
                            <span style="display: inline-block; width: 80px; text-align: left;">Contact Person</span><span style="display: inline-block; width: 12px; text-align: left;">:</span>
                        </td>
                        <td style="padding: 4px 0; border: none; vertical-align: top;">{{ $purchaseOrder->vendor_contact_person ?: '—' }}</td>
                    </tr>
                </table>
            </td>
            <td style="width: 25%; vertical-align: top; padding-left: 24px; line-height: 1.5; text-align: left;">
                <div style="margin-bottom: 8px; text-align: left;">Date : {{ $poDateFormatted }}</div>
                <div style="text-align: left;">Ref. No : {{ $purchaseOrder->ref_number ?? '' }}</div>
                <div style="height: 10px;"></div>
                <div style="margin-bottom: 4px; text-align: left;"><strong>Ship to</strong> :</div>
                <div style="font-weight: bold; text-align: left;">PT. RUANG SOLUSI INTERNUSA</div>
                <div style="text-align: left;">{{ $purchaseOrder->ship_to_address ?? 'Bintara Alam Permai, Jl. Alam Utama Raya 1A Blok A No. 6 Bintara Jaya' }}</div>
                <div style="text-align: left;">Bekasi Barat 17136</div>
            </td>
        </tr>
    </table>

    <!-- ITEMS: No | Description | Part Number | QTY | UOM | Unit Price | Total IDR -->
    <table class="items-main" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="col-no text-center">No</th>
                <th class="col-desc text-left">Description</th>
                <th class="col-part text-center">Part Number</th>
                <th class="col-qty text-center">QTY</th>
                <th class="col-uom text-center">UOM</th>
                <th class="col-unit text-right">Unit Price</th>
                <th class="col-total text-right">Total IDR</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td class="col-no text-center">{{ $i + 1 }}</td>
                <td class="col-desc text-left" style="white-space: pre-line;">{{ $item->description ?? '' }}</td>
                <td class="col-part text-center">{{ $item->part_number ?? '—' }}</td>
                <td class="col-qty text-center">{{ $fmt($item->quantity) }}</td>
                <td class="col-uom text-center">{{ $item->uom ?? '' }}</td>
                <td class="col-unit text-right">{{ $fmt($item->unit_price) }}</td>
                <td class="col-total text-right">{{ $fmt($item->total_price) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- BOTTOM: Note kiri | Summary + Tanda tangan kanan -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 25px;">
        <tr>
            <td style="width: 55%; vertical-align: top; padding-right: 20px;">
                <div style="font-size: 12px; font-weight: bold; margin-bottom: 6px;">Note :</div>
                <div style="font-size: 11px; line-height: 1.6;">
                    - All shipments must include notes, invoices and receipts<br>
                    - We will return the goods if not in accordance with the order<br>
                    - Purchase order (PO) number must be listed on the note / invoice / receipt<br>
                    - If delivery of goods by partial, please include a copy of the PO
                </div>
            </td>
            <td style="width: 45%; vertical-align: top;">
                <table class="summary-table" style="margin-left: auto; margin-bottom: 25px;">
                    <tr>
                        <td style="text-align: left;"><strong>Sub Total</strong></td>
                        <td style="text-align: right;">{{ $fmt($purchaseOrder->subtotal) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>VAT</strong></td>
                        <td style="text-align: right;">{{ $fmt($purchaseOrder->vat_amount) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; text-decoration: underline;"><strong>Balance Due</strong></td>
                        <td style="text-align: right; text-decoration: underline;"><strong>{{ $fmt($purchaseOrder->total_amount) }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Tanda tangan tetap di paling bawah kanan kertas (position: fixed) -->
    <div class="signature-fixed" style="text-align: right;">
        <div style="margin-bottom: 20px;">Yours Faithfully</div>
        <div style="margin: 0 auto 0 auto; width: 210px; min-height: 80px;">
            <img src="{{ public_path('img/tandaa.jpeg') }}" alt="Signature" style="display: block; margin: 0 auto; max-height: 80px; max-width: 210px;">
        </div>
        <div style="margin-top: 20px; font-weight: bold;">{{ optional($purchaseOrder->signatoryEmployee)->name ?? 'Nani Hadijah' }}</div>
        <div>{{ optional($purchaseOrder->signatoryEmployee)->position ?? '' }}</div>
    </div>

</body>
</html>
