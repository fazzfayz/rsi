<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pembukuan - {{ $pembukuan->nama_project }}</title>
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
        }
        table.items-main th,
        table.items-main td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
        }
        table.items-main th {
            background: #e9ecef;
            font-weight: bold;
        }
        table.summary-table {
            width: 280px;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 15px;
            margin-left: auto;
        }
        table.summary-table td {
            border: 1px solid #000;
            padding: 6px 10px;
        }
        .col-no { width: 5%; }
        .col-nama { width: 35%; }
        .col-qty { width: 15%; }
        .col-harga { width: 22%; }
        .col-total { width: 23%; }
    </style>
</head>
<body>

    @php
        $fmt = function ($n) { return number_format((float) ($n ?? 0), 0, ',', '.'); };
        $items = $pembukuan->items ?? collect();
    @endphp

    <div style="text-align: left; margin-bottom: 24px;">
        <img src="{{ public_path('img/rsi.png') }}" alt="Logo RSI" style="height: 90px; display: block; margin-bottom: 12px;">
        <h2 style="margin: 0 0 4px 0; font-size: 18px; text-align: center;  ">Laporan Pembukuan</h2>
        <div style="font-size: 14px; font-weight: bold; text-align: center;">{{ $pembukuan->nama_project }}</div>
    </div>

    <table style="width: 100%; border: none; margin-bottom: 16px; font-size: 12px;">
        <tr>
            <td style="width: 50%; border: none; padding: 4px 0;"><strong>Tanggal Mulai</strong> : {{ $pembukuan->tanggal_mulai ? $pembukuan->tanggal_mulai->format('d F Y') : '—' }}</td>
            <td style="width: 50%; border: none; padding: 4px 0;"><strong>Tanggal Berakhir</strong> : {{ $pembukuan->tanggal_berakhir ? $pembukuan->tanggal_berakhir->format('d F Y') : '—' }}</td>
        </tr>
    </table>

    <div style="font-weight: bold; margin-bottom: 6px;">Tabel Barang</div>
    <table class="items-main" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="col-no text-center">No</th>
                <th class="col-nama text-left">Nama Barang</th>
                <th class="col-qty text-center">Quantity</th>
                <th class="col-harga text-right">Harga Barang</th>
                <th class="col-total text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td class="col-no text-center">{{ $i + 1 }}</td>
                <td class="col-nama text-left">{{ $item->nama_barang ?? '' }}</td>
                <td class="col-qty text-center">{{ $fmt($item->quantity) }}</td>
                <td class="col-harga text-right">Rp {{ $fmt($item->harga_barang) }}</td>
                <td class="col-total text-right">Rp {{ $fmt($item->total) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td class="text-left"><strong>Jumlah Total</strong></td>
            <td class="text-right">Rp {{ $fmt($pembukuan->total_jumlah) }}</td>
        </tr>
        <tr>
            <td class="text-left"><strong>Income</strong></td>
            <td class="text-right">Rp {{ $fmt($pembukuan->income) }}</td>
        </tr>
        <tr>
            <td class="text-left"><strong>Selisih</strong></td>
            <td class="text-right">
                @if($pembukuan->selisih_status === 'profit')
                    <strong>Profit Rp {{ $fmt($pembukuan->selisih) }}</strong>
                @elseif($pembukuan->selisih_status === 'loss')
                    <strong>Loss Rp {{ $fmt($pembukuan->selisih) }}</strong>
                @else
                    Rp 0
                @endif
            </td>
        </tr>
    </table>

    <div style="margin-top: 30px; font-size: 11px; color: #666;">
        Dokumen ini dicetak pada {{ now()->format('d F Y H:i') }}
    </div>

</body>
</html>
