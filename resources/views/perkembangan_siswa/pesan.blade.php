@extends('layouts.master')

@section('title', 'Pesan Guru')

@section('content')
<header class="mb-4">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <!-- Foto Profil -->
            <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : asset('images/default-avatar.jpg') }}" alt="Foto Profil" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
            
            <!-- Nama Siswa -->
            <h3 style="margin: 0;">{{ $siswa->nama }}</h3>
        </div>
    </h2>
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/pesan.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</header>

<div class="chat-container">
    <!-- Bagian Pesan -->
    <div class="chat-box">
        <div class="messages">
            @foreach ($pesan as $item)
                <div class="message {{ $item->id_pengirim == auth()->id() ? 'sent' : 'received' }}">
                    <div class="message-content">
                        <p>{{ $item->pesan }}</p>
                        <span class="message-time">{{ date('H:i', strtotime($item->waktu_kirim)) }}</span>
                        @if ($item->id_pengirim == auth()->id())
                            <div class="message-actions">
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pesan.destroy', $item->id_pesan) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- Tombol Edit -->
                                <button class="update-icon" onclick="editMessage('{{ $item->id_pesan }}', '{{ $item->pesan }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bagian Form Kirim Pesan -->
    <div class="message-input">
        <form action="{{ route('pesan.store', ['nis' => $siswa->nis]) }}" method="POST" style="display: flex; width: 100%; gap: 10px;">
            @csrf
            <textarea name="pesan" id="pesan" class="form-control" placeholder="Tulis pesan..." rows="1" required></textarea>
            <button type="submit" class="btn-send">Kirim</button>
        </form>
    </div>
</div>

<!-- JavaScript untuk Edit Pesan -->
<script>
    function editMessage(idPesan, pesanLama) {
        const pesanBaru = prompt('Edit pesan:', pesanLama);
        if (pesanBaru !== null && pesanBaru.trim() !== '') {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/pesan/${idPesan}`;
            form.innerHTML = `
                @csrf
                @method('PUT')
                <input type="hidden" name="pesan" value="${pesanBaru}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection
