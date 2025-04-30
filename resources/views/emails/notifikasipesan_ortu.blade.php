<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pesan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
        }

        strong {
            color: #555;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halo, Anda menerima pesan baru</h1>
        <p><strong>Isi Pesan:</strong> {{ $pesan->pesan }}</p>
        <p><strong>Waktu Kirim:</strong> {{ $pesan->waktu_kirim->format('d M Y H:i') }}</p>
        <p>Silakan buka aplikasi untuk melihat dan membalas pesan ini.</p>
        <div class="footer">
            <p>Terima kasih.</p>
        </div>
    </div>
</body>
</html>
