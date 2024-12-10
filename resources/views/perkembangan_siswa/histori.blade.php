@extends('layouts.master')

@section('title', 'Histori Perkembangan')

@section('content')
<header class="mb-4 header-container">
    <h2 class="text-uppercase text-white py-4 px-3 header-title">
        Histori Perkembangan - {{ $siswa->nama }}
    </h2>
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/histori.css') }}">
</header>

<div class="wrapper">
    <div class="container mt-5">
        <div class="history-container mt-4">
            @forelse($histori as $item)
                <!-- Item histori -->
                <div class="history-item">
                    <div class="history-content">
                        <div class="date">{{ $item->waktu }}</div>
                        <h3>{{ $item->jadwal_pelajaran }}</h3>
                        <p>{{ $item->penjelasan_perkembangan }}</p>
                        <!-- Catatan dengan styling khusus -->
                        <p class="highlight-note"><strong>Catatan:</strong> {{ $item->catatan }}</p>
                    </div>
                    <!-- Gambar bukti media (bulat) di sebelah kanan -->
                    @if($item->bukti_media)
                        <div class="bukti-media">
                            <img src="{{ asset('storage/' . $item->bukti_media) }}" alt="Bukti Media" class="bukti-media-img">
                        </div>
                    @endif
                    <!-- Tombol Hapus -->
                    <form action="{{ route('perkembangan_siswa.destroy', $item->id_perkembangan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">🗑️</button>
                    </form>
                </div>
            @empty
                <!-- Jika tidak ada histori -->
                <p>Belum ada histori perkembangan untuk siswa ini.</p>
            @endforelse
        </div>

        <!-- Tombol Unduh -->
        <div class="download-button-container">
            <a href="{{ route('histori.download', ['nis' => $siswa->nis]) }}" class="btn-download">
                <i class="fas fa-download"></i> Unduh PDF
            </a>
        </div>        
    </div>
</div>
@endsection
