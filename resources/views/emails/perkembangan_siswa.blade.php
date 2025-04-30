<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Perkembangan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 20px;
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin: 10px 0;
        }
        .highlight {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notifikasi Perkembangan</h1>
        <p>Yth. Orang Tua/Wali Siswa,</p>
        <p>Kami ingin menginformasikan bahwa terdapat perkembangan terbaru terkait siswa :  
            <span class="highlight">{{ $data['nama'] }}</span> dengan NIS : <span class="highlight">{{ $data['nis'] }}</span>.
        </p>
        <p>Untuk informasi lebih lanjut dan detail perkembangannya, silakan kunjungi website kami melalui tautan berikut :  
            <a href="[link website]" target="_blank">[link website]</a>.
        </p>
        <p>Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
        <p>Terima kasih atas perhatian Anda.</p>
        <div class="footer">
            Salam hangat,<br>
            TK Bunda Pertiwi<br>
            <a href="mailto:tkbundapertiwi@gmail.com">tkbundapertiwi@gmail.com</a>
        </div>
    </div>
</body>
</html>
