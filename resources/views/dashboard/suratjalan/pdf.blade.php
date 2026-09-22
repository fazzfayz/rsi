<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan - {{ $deliveryOrder->do_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm 1.5cm;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt; 
            line-height: 1.3;
            color: #000;
        }

        /* Bungkus per-halaman agar bisa dipaksa 10 item per halaman */
.page {
    width: 100%;
}
        .page-break {
            page-break-after: always;
        }
        
        /* HEADER */
        .header-table { width: 100%; margin-bottom: 20px; }
        .logo-img { width: 140px; height: auto; }
        .company-info { text-align: right; font-size: 10pt; line-height: 1.2; }
        .company-name { font-size: 12pt; font-weight: bold; margin-bottom: 4px; }

        /* JUDUL */
        .title-container { text-align: center; margin-bottom: 25px; }
        .surat-title { font-size: 14pt; font-weight: bold; text-decoration: underline; text-transform: uppercase; letter-spacing: 1px; }
        .surat-no { font-size: 11pt; font-weight: bold; margin-top: 2px; }

        /* PENERIMA */
        .recipient-table { width: 100%; margin-bottom: 20px; font-size: 11pt; }
        .lbl { width: 40px; font-weight: bold; vertical-align: top; }
        .sep { width: 10px; vertical-align: top; }
        .val { vertical-align: top; }

        /* TABEL BARANG (NORMAL, TANPA BARIS TAMBAHAN) */
        .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 10px; font-size: 10pt; }
        .items-table th { border: 1px solid #000; background-color: #d9d9d9; padding: 6px; text-align: left; font-weight: bold; text-transform: uppercase; }
        .items-table td { border: 1px solid #000; padding: 6px; vertical-align: top; }
        
        .col-no { width: 5%; text-align: center; }
        .col-name { width: 40%; }
        .col-qty { width: 8%; text-align: center; }
        .col-po { width: 30%; }
        .col-uom { width: 10%; text-align: center; }

        /* SECTION TANDA TANGAN (POSISI ABSOLUTE DI BAWAH) */
.signature-section {
    width: 100%;
    margin-top: 20px;
}

        .signature-table {
            width: 100%;
            font-size: 11pt;
        }
        .bold { font-weight: bold; }
        .text-right { text-align: right; }
        
        /* SPACING INTERNAL TANDA TANGAN */
        .h-space-ttd { height: 80px; } /* Jarak tanda tangan */
        .h-space-gap { height: 50px; } /* Jarak antara Pembawa dan Penerima */

        .dotted-line {
            border-bottom: 1px dotted #000;
            display: block;
            width: 80%;
        }
        .dotted-line-right {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 80%;
        }

    </style>
</head>
<body>

@php
    $itemsChunks = $deliveryOrder->items->values()->chunk(10);
    $lastPageIndex = max(0, $itemsChunks->count() - 1);
    $no = 1; // ✅ FIX COUNTER GLOBAL
@endphp

    @foreach($itemsChunks as $pageIndex => $items)
        <div class="page {{ $pageIndex < $lastPageIndex ? 'page-break' : '' }}">
            <table class="header-table">
                <tr>
                    <td width="40%" style="vertical-align: top;">
                        <img src="{{ public_path('img/rsi.png') }}" alt="Logo" class="logo-img">
                    </td>
                    <td width="60%" class="company-info" style="vertical-align: top;">
                        <div class="company-name">PT. RUANG SOLUSI INTERNUSA</div>
                        <div>Bintara Alam Permai</div>
                        <div>Jalan Alam Utama Raya 1A Blok A No.6</div>
                        <div>Bintara Jaya - Bekasi Barat 17136</div>
                        <div>021-29195365</div>
                        <div><a href="http://www.ruang-solusi.com" style="text-decoration:none; color:#000;">www.ruang-solusi.com</a></div>
                    </td>
                </tr>
            </table>

            <div class="title-container">
                <div class="surat-title">SURAT JALAN</div>
                <div class="surat-no">No. {{ $deliveryOrder->do_number }}</div>
            </div>

            <div class="recipient-table">
                <table width="100%">
                    <tr>
                        <td class="lbl">To</td>
                        <td class="sep"></td>
                        <td class="val bold">
                            {{ $deliveryOrder->client->name }}<br>
                            <span style="font-weight: normal;">
                                {{ $deliveryOrder->shipping_address ?? $deliveryOrder->client->address }}
                            </span>
                        </td>
                    </tr>
                    <tr><td colspan="3" style="height: 10px;"></td></tr>
                    <tr>
                        <td class="lbl">Attn</td>
                        <td class="sep">:</td>
                        <td class="val bold">
                            {{ $deliveryOrder->attention_to ?? $deliveryOrder->client->contact_person ?? '-' }}
                        </td>
                    </tr>
                </table>
            </div>

            <div style="margin-bottom: 5px; font-size: 11pt;">
                Dengan Hormat,<br>
                Bersama surat ini kami mengirimkan dokumen/barang dengan perincian sebagai berikut:
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th class="col-no">No.</th>
                        <th class="col-name">NAMA BARANG</th>
                        <th class="col-qty">QTY</th>
                        <th class="col-po">PO Number</th>
                        <th class="col-uom">UOM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                        <tr>
                            <td class="col-no">{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="col-qty">{{ $item->quantity }}</td>
                            <td>{{ $item->po_number ?? '-' }}</td>
                            <td class="col-uom">{{ $item->unit ?? 'Unit' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($pageIndex === $lastPageIndex)
                <div style="margin-bottom: 10px; font-size: 11pt;">
                    Mohon diperiksa kondisi barang dan diterima.
                </div>
<br>
<br>
                <div class="signature-section">
                    <table class="signature-table">
                        <tr>
                            <td width="50%" class="bold">Pembawa</td>
              
                            <td width="50%" class="bold text-right" style="padding-right: 40px;">Hormat Kami,</td>
                        </tr>

                        <tr>
                            <td class="h-space-ttd"></td>
                            <td class="h-space-ttd"></td>
                        </tr>

                        <tr>
                            <td>{{ $deliveryOrder->signerEmployee->name ?? '...........................' }}</td>
                       
                            <td style="text-align: right; padding-right: 0;">
                                <div style="display: flex; flex-direction: column; align-items: flex-end; width: 100%;">
                                    <div style="height: 0px;"></div>
                                    <img src="{{ public_path('img/tandaa.jpeg') }}" 
                                         alt="Tanda Tangan" 
                                         style="
                                            width: 150px; 
                                            max-height: 120px; 
                                            height: auto;
                                            object-fit: contain; 
                                            background: white;
                                            margin-left: auto;
                                            margin-right: 0;
                                            margin-top: -20px;
                                         ">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="h-space-gap"></td>
                            <td class="h-space-gap"></td>
                        </tr>

                        <tr>
                            <td class="bold">Penerima,</td>
                            <td class="bold text-right">Barang telah diterima pada tanggal</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="text-right">
                                {{ \Carbon\Carbon::parse($deliveryOrder->delivery_date)->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="h-space-ttd" style="vertical-align: bottom;">
                                <div class="dotted-line"></div>
                            </td>
                            <td class="h-space-ttd" style="vertical-align: bottom; text-align: right;">
                                <div class="dotted-line-right"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
    @endforeach

</body>
</html>