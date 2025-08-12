<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas - {{ $letter->letter_number }}</title>
    <style>
        @page {
            size: A4;
            margin-top: 3cm;
            margin-bottom: 3cm;
            margin-left: 3cm;
            margin-right: 3cm;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            max-width: 100vw;
            overflow: hidden;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            justify-content: center;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin-right: 0;
            flex-shrink: 0;
        }
        .letter-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
            margin: 25px 0 15px 0;
        }
        .letter-number {
            text-align: center;
            font-size: 12pt;
            margin-bottom: 20px;
        }
        .content {
            text-align: justify;
            margin-bottom: 25px;
            font-size: 12pt;
            padding: 0 10px;
        }
        .signer-info {
            margin-bottom: 15px;
        }
        .signer-name {
            font-weight: bold;
        }
        .assignment-info {
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 30px;
            text-align: left;
            padding: 0 10px;
        }
        .footer-table {
            width: 100%;
            margin-top: 0;
        }
        .footer-table td {
            vertical-align: top;
            font-size: 12pt;
        }
        .date-location {
            text-align: left;
            padding-bottom: 0;
            margin-bottom: 0;
        }
        .signature-block {
            text-align: left;
            width: 240px;
            min-height: 90px;
            margin-left: 0;
            margin-right: auto;
        }
        .signature-space {
            height: 70px;
            /* Space for signature */
        }
        .signature-line {
            border-top: 1px solid #000;
            margin: 0 0 4px 0;
            width: 180px;
        }
        .task-details {
            margin: 15px 0 15px 0;
            padding-left: 20px;
        }
        .task-details ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .task-details li {
            margin-bottom: 5px;
            font-size: 11pt;
        }
        .separator {
            border-top: 1px solid #000;
            margin: 30px 0 15px 0;
        }
        .company-footer {
            text-align: center;
            font-size: 7pt;
            color: #666;
            margin-top: 10px;
            padding: 0 10px;
        }
        .company-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        p {
            margin: 8px 0;
        }
        table {
            page-break-inside: avoid;
        }
        /* Prevent page break inside important blocks */
        .content, .footer, .company-footer {
            page-break-inside: avoid;
        }
        /* Force single page: prevent all page breaks inside body */
        body, .container {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
            page-break-after: avoid !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header/Kop Surat - Logo di tengah atas -->
        <div class="header">
            <img src="{{ public_path('img/rsi.png') }}" alt="Ruang Solusi Internusa Logo" class="logo" style="object-fit: contain;">
        </div>

        <!-- Judul Surat -->
        <div class="letter-title">SURAT TUGAS</div>

        <!-- Nomor Surat -->
        <div class="letter-number">
            Nomor: {{ $letter->letter_number }}
        </div>

        <!-- Isi Surat -->
        <div class="content">
            <p style="font-size: 12pt; margin-bottom: 10px;">Yang bertanda tangan di bawah ini:</p>
            
            <table style="margin-left: 20px; margin-bottom: 15px;">
                <tr>
                    <td style="font-weight: bold; width: 90px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->signer->name }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Jabatan</td>
                    <td>:</td>
                    <td>{{ $letter->signer->position }}</td>
                </tr>
            </table>

            <p style="font-size: 12pt; margin-bottom: 10px;">Dengan ini memberikan perintah kerja kepada:</p>
            
            <table style="margin-left: 20px; margin-bottom: 15px;">
                <tr>
                    <td style="font-weight: bold; width: 90px;">Nama</td>
                    <td style="width: 12px;">:</td>
                    <td>{{ $letter->assignedTo->name }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Jabatan</td>
                    <td>:</td>
                    <td>{{ $letter->assignedTo->position }}</td>
                </tr>
            </table>

            <p>Untuk melakukan pekerjaan perawatan komputer, laptop, dan server di {{ $letter->location }}, dengan perincian sebagai berikut:</p>

            <div class="task-details">
                <ul>
                    <li>Sistem Boot</li>
                    <li>Sistem Log-in</li>
                    <li>Konfigurasi Jaringan</li>
                    <li>Konfigurasi Hardware</li>
                    <li>Konfigurasi Browser/Proxy</li>
                    <li>Software Umum (Office, Email, Video Player, Music Player)</li>
                    <li>Virus dan Malware</li>
                    <li>Clearance</li>
                    <li>Komponen Pendukung</li>
                    <li>Hardware lain</li>
                </ul>
            </div>

            <p>Demikian surat tugas ini dibuat agar dapat dilaksanakan dengan sebaik-baiknya. Jika di lapangan terdapat suatu kondisi di luar ketentuan surat ini, dapat dibicarakan lebih lanjut.</p>
        </div>

        <!-- Footer dan Tanda Tangan -->
        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td style="width:50%">
                        <div class="date-location">
                            Jakarta, {{ $letter->formatted_assignment_date }}<br>
                            <strong>PT RUANG SOLUSI INTERNUSA</strong>
                        </div>
                        <div class="signature-block">
                            <div class="signature-space"></div>
                            <div class="signature-line"></div>
                            <div style="margin-top:2px;">
                                <strong>{{ $letter->signer->name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td style="width:50%"></td>
                </tr>
            </table>
        </div>

        <!-- Garis Pemisah -->
        <div class="separator"></div>

        <!-- Footer dengan info perusahaan -->
        <div class="company-footer">
            <div class="company-name">PT RUANG SOLUSI INTERNUSA</div>
            <div>
                Bintara Alam Permai, Jalan Alam Utama Raya 1A Blok A no. 6 Bintara Jaya - Bekasi Barat 17136<br>
                Jalan Pondok Kelapa Timur E11 No. 2, Pondok Kelapa, Duren Sawit - Jakarta Timur<br>
                T:+6221-86943113, e:info@ruangsolusi.com<br>
                www.ruangsolusi.com
            </div>
        </div>
    </div>
</body>
</html> 