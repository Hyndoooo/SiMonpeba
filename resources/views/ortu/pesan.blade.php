@extends('layouts.master_user')

@section('title', 'Pesan Ortu')

@section('content')
<header class="mb-4">
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/pesanortu.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</header>

<div class="header-content">
    <!-- Info Guru -->
    @if($id_penerima)
        @php
            $guru = $gurus->firstWhere('id', $id_penerima);
        @endphp
        <div class="guru-info">
            <img src="{{ $guru->foto_profil ? asset('storage/' . $guru->foto_profil) : asset('images/default-avatar.jpg') }}" alt="Foto Profil" class="guru-photo">
            <h3>{{ $guru->nama }}</h3>
        </div>
    @endif

    <!-- Dropdown Guru -->
    <div class="dropdown-guru">
        <form action="{{ route('ortu.pesan.index') }}" method="GET">
            <select name="id_penerima" onchange="this.form.submit()" class="form-control" required>
                <option value="">Pilih Guru</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}" {{ $id_penerima == $guru->id ? 'selected' : '' }}>
                        {{ $guru->nama }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

@if($id_penerima)
    <!-- Bagian Pesan -->
    <div class="chat-container">
        <div class="chat-box">
            <div class="messages">
                @foreach ($pesanDikirim->concat($pesanDiterima)->sortBy('waktu_kirim') as $item)
                <div class="message {{ $item->id_pengirim == auth()->id() ? 'sent' : 'received' }}" data-id="{{ $item->id_pesan }}">
                    <div class="message-content">
                        <p>{{ $item->pesan }}</p>
                        <span class="message-time">{{ date('H:i', strtotime($item->waktu_kirim)) }}</span>
                    </div>
                    @if ($item->id_pengirim == auth()->id())
                        <div class="message-actions">
                            <form action="{{ route('ortu.pesan.destroy', $item->id_pesan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-icon" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <button class="update-icon" title="Edit" onclick="editMessage(this, '{{ addslashes($item->pesan) }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Form Kirim Pesan -->
        <div class="message-input">
            <form action="{{ route('ortu.pesan.store', ['id_penerima' => $id_penerima]) }}" method="POST" style="display: flex; width: 100%; gap: 10px;">
                @csrf
                <textarea name="pesan" id="pesan" class="form-control" placeholder="Tulis pesan..." rows="1" required></textarea>
                <button type="submit" class="btn-send">Kirim</button>
            </form>
        </div>
    </div>
@endif

<script>
    function editMessage(button, pesanLama) {
    const messageId = button.closest('.message').dataset.id; // Ambil ID Pesan
    if (!messageId) {
        console.error("ID pesan tidak ditemukan!");
        return;
    }

    const newPesan = prompt("Edit pesan:", pesanLama); // Prompt untuk pesan baru
    if (newPesan !== null && newPesan.trim() !== "") {
        const updateUrl = "{{ route('ortu.pesan.update', ':id') }}".replace(':id', messageId); // URL Update

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = updateUrl;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = "{{ csrf_token() }}";

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';

        const pesanInput = document.createElement('input');
        pesanInput.type = 'hidden';
        pesanInput.name = 'pesan';
        pesanInput.value = newPesan;

        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        form.appendChild(pesanInput);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
