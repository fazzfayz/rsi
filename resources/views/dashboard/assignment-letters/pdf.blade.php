<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas RSI</title>
    <style>
        /* 1. PENGATURAN HALAMAN YANG LEBIH HEMAT TEMPAT */
        @page {
            size: A4;
            margin: 1cm 2cm 1cm 2cm; /* Margin Atas/Bawah diperkecil jadi 1cm */
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt; /* FONT DIPERKECIL */
            line-height: 1.15; /* SPASI BARIS LEBIH RAPAT */
            color: #000;
        }

        /* HEADER & LOGO */
        .header {
            margin-bottom: 10px; /* Jarak dikurangi */
        }
        .logo {
            width: 150px; /* Logo sedikit diperkecil */
            height: auto;
        }

        /* JUDUL SURAT */
        .title-section {
            text-align: center;
            margin-bottom: 20px; /* Jarak ke isi surat dikurangi */
        }
        .letter-title {
            font-size: 14pt; /* Font judul sedikit diperkecil */
            font-weight: normal;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .letter-number {
            font-size: 10pt;
        }

        /* TABEL BIODATA */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Jarak dikurangi */
        }
        .info-table td {
            vertical-align: top;
            padding: 1px 0; /* Padding baris diperkecil */
        }
        .col-label { width: 100px; }
        .col-separator { width: 15px; text-align: center; }

        /* LIST PEKERJAAN */
        .task-list {
            margin: 5px 0 10px 0; /* Margin atas bawah dikurangi */
            padding-left: 20px;
        }
        .task-list li {
            padding-left: 5px;
            margin-bottom: 0px; /* Jarak antar item list dirapatkan */
        }

        /* TANDA TANGAN */
        .signature-section {
            margin-top: 20px; /* Jarak dari text penutup ke TTD dikurangi */
            width: 100%;
            page-break-inside: avoid;
        }
        .signature-box {
            width: 350px;
            text-align: left;
        }
        .signature-img {
            height: 60px; /* Tinggi TTD disesuaikan */
            display: block;
            margin: 2px 0;
            object-fit: contain;
            object-position: left;
        }
        .signature-space {
            height: 60px;
        }

        /* FOOTER */
        .footer {
            position: relative;
            margin-top: 90px; /* Jarak dari TTD ke Footer dikurangi */
            width: 100%;
            font-size: 7pt; /* Font footer diperkecil */
            color: #444;
            text-align: center;
            line-height: 1.2;
            border-top: 1px solid #888;
            padding-top: 5px;
            page-break-inside: avoid;
        }
        .footer strong {
            color: #000;
            display: block;
        }

        /* UTILITY */
        p { margin: 5px 0; text-align: justify; } /* Margin paragraf dikurangi */
        .bold { font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/rsi.png') }}" class="logo">
    </div>

    <div class="title-section">
        <div class="letter-title">SURAT TUGAS</div>
        <div class="letter-number">No. {{ $letter->letter_number ?? '...../ST-RSI/...../2024' }}</div>
    </div>

    <p>Yang bertanda tangan di bawah ini:</p>
    <table class="info-table">
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-separator">:</td>
            <td>{{ $letter->signer->name ?? '....................................' }}</td>
        </tr>
        <tr>
            <td class="col-label">Jabatan</td>
            <td class="col-separator">:</td>
            <td>{{ $letter->signer->position ?? '....................................' }}</td>
        </tr>
    </table>
    <br>
    <p>Memberikan perintah kerja kepada:</p>
    <table class="info-table">
        <tr>
            <td class="col-label">Nama</td>
            <td class="col-separator">:</td>
            <td>{{ $letter->assignedTo->name ?? '....................................' }}</td>
        </tr>
        <tr>
            <td class="col-label">Jabatan</td>
            <td class="col-separator">:</td>
            <td>{{ $letter->assignedTo->position ?? '....................................' }}</td>
        </tr>
    </table>
    <br>
    <p>
        Untuk melakukan Pekerjaan Perawatan Komputer, Laptop dan Server di 
        <span class="bold">{{ $letter->location ?? '................................................' }}</span>, 
        dengan perincian sebagai berikut:
    </p>
    <br>
    <ol class="task-list">
        <li>Sistem Boot</li>
        <li>Sistem Log-in</li>
        <li>Konfigurasi Jaringan</li>
        <li>Konfigurasi Hardware</li>
        <li>Konfigurasi Browser/Proxy</li>
        <li>Software Umum (Office, Email, Video Player, Music Player)</li>
        <li>Virus dan Malware</li>
        <li>Clearance</li>
        <li>Komponen Pendukung</li>
        <li>Hardware Lain</li>
    </ol>
    <br>
    <p>
        Demikian Surat Tugas ini dibuat agar dapat dilaksanakan sebaik-baiknya. Jika di lapangan terdapat suatu kondisi di luar ketentuan surat ini, dapat dibicarakan lebih lanjut.
    </p>
    <br>
    <div class="signature-section">
        <div class="signature-box">
            <div>Jakarta, {{ $letter->formatted_assignment_date }}</div>
       
            <div style="font-weight: bold; margin-bottom: 2px;">PT RUANG SOLUSI INTERNUSA</div>
            
            @if(!empty($letter->signer->signature_path) && file_exists(public_path($letter->signer->signature_path)))
                <img src="{{ public_path($letter->signer->signature_path) }}" class="signature-img" alt="TTD">
            @else
                <div class="signature-space"></div>
            @endif
            
            <div>{{ $letter->signer->name ?? '( .................................... )' }}</div>
        </div>
    </div>

    <div class="footer">
        <strong>PT RUANG SOLUSI INTERNUSA</strong>
        Bintara Alam Permai, Jalan Alam Utama Raya 1A Blok A No. 6 Bintara Jaya - Bekasi Barat 17136<br>
        Jalan Pondok Kelapa Timur E11 No. 2, Pondok Kelapa, Duren Sawit - Jakarta Timur<br>
        T: +6221-86943113, e: info@ruang-solusi.com<br>
        www.ruang-solusi.com
    </div>

</body>
</html>