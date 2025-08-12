<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background-color: #2563EB; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pesan dari Website IT Solusi</h2>
    </div>

    <div class="content">
        <p><strong>Nama:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Pesan:</strong></p>
        <p>{{ $messageContent }}</p>
    </div>

    <div class="footer">
        Email ini dikirim otomatis dari formulir kontak IT Solusi pada {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>
</html>
