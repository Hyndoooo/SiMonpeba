<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/pesan.css') }}">
</head>
<body>
    <header class="mb-4 header-container">
        <!-- Tambahkan elemen header jika diperlukan -->
    </header>

    <div class="chat-container">
        <!-- Bagian Pesan -->
        <div class="chat-box">
            <div class="header-chat">
                <h4>Pesan</h4>
            </div>
            
            <div class="messages">
                <!-- Pesan yang Diterima -->
                @foreach ($pesanDiterima as $pesan)
                    <div class="message received">
                        <div class="message-content">
                            <strong>{{ $pesan->pengirim->username }}</strong>
                            <p>{{ $pesan->pesan }}</p>
                            <span class="message-time">{{ $pesan->waktu_kirim }}</span>
                        </div>
                    </div>
                @endforeach
                
                <!-- Pesan yang Dikirim -->
                @foreach ($pesanDikirim as $pesan)
                    <div class="message sent">
                        <div class="message-content">
                            <strong>{{ $pesan->penerima->username }}</strong>
                            <p>{{ $pesan->pesan }}</p>
                            <span class="message-time">{{ $pesan->waktu_kirim }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bagian Form Kirim Pesan -->
        <div class="message-input">
            <form action="{{ route('pesan.store', 2) }}" method="POST" style="display: flex; width: 100%; gap: 10px;">
                @csrf
                <textarea name="pesan" id="pesan" class="form-control" placeholder="Tulis pesan..." rows="1" required></textarea>
                <button type="submit" class="btn-send">Kirim</button>
            </form>
        </div>
    </div>
</body>
</html>
