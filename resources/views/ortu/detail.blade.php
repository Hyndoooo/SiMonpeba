@extends('layouts.master_user')

@section('title', 'Detail Perkembangan Siswa')

@section('content')
<header class="mb-4" style="background-color: #1AABA5; position: relative;">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Detail Perkembangan Siswa
    </h2>
    <div class="header-buttons">
        <button class="btn-icon" onclick="location.href='{{ route('histori.ortu', ['nis' => $siswa->nis]) }}'">
            <i class="fas fa-history"></i> HISTORI
        </button>
        <button class="btn-icon" onclick="goToMessage()">
            <i class="fas fa-envelope"></i> PESAN
        </button>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/detailortu.css') }}">
</header>

<div class="tabs">
    <ul>
        <li id="data-siswa-tab" class="tab {{ request()->routeIs('ortu.dashboard') ? 'active' : '' }}">
            <a href="{{ route('ortu.dashboard') }}">Biodata</a>
        </li>
        <li id="perkembangan-siswa-tab" class="tab {{ request()->routeIs('ortu.detail') ? 'active' : '' }}">
            <a href="{{ route('ortu.detail', ['nis' => $siswa->nis]) }}">Perkembangan</a>
        </li>
    </ul>
</div>

<div class="outer-container">
    <div class="container card shadow-sm p-4">
        <div class="row">
            <!-- Bukti media -->
            <div class="col-md-3 text-left">
                <label class="form-label fw-bold">Bukti Media</label>
                <div class="d-flex justify-content-start align-items-center">
                    <div class="foto-profil-wrapper">
                        <div class="foto-profil-container">
                            <a href="{{ route('bukti.media', ['nis' => $siswa->nis]) }}" class="btn btn-primary">
                                <i class="fas fa-file-image"></i> Lihat Bukti Media
                            </a>                            
                        </div>
                    </div>                    
                </div>
                <br>
            </div>

            <!-- Form Display -->
            <div class="col-md-9">
                <!-- Waktu -->
                <div class="row mb-3">
                    <label for="waktu" class="col-md-4 col-form-label">Waktu</label>
                    <div class="col-md-8">
                        <input type="text" id="waktu" class="form-control" value="{{ $perkembangan->waktu }}" readonly>
                    </div>
                </div>

                <!-- NIS -->
                <div class="row mb-3">
                    <label for="nis" class="col-md-4 col-form-label">Nomor Induk Siswa</label>
                    <div class="col-md-8">
                        <input type="text" id="nis" class="form-control" value="{{ $siswa->nis }}" readonly>
                    </div>
                </div>

                <!-- Nama -->
                <div class="row mb-3">
                    <label for="nama" class="col-md-4 col-form-label">Nama Siswa</label>
                    <div class="col-md-8">
                        <input type="text" id="nama" class="form-control" value="{{ $siswa->nama }}" readonly>
                    </div>
                </div>

                <!-- Jadwal Pelajaran -->
                <div class="row mb-3">
                    <label for="jadwal_pelajaran" class="col-md-4 col-form-label">Jadwal Pelajaran</label>
                    <div class="col-md-8">
                        <input type="text" id="jadwal_pelajaran" class="form-control" value="{{ $perkembangan->jadwal_pelajaran }}" readonly>
                    </div>
                </div>

                <!-- Penjelasan Perkembangan -->
                <div class="row mb-3">
                    <label for="penjelasan_perkembangan" class="col-md-4 col-form-label">Detail Perkembangan</label>
                    <div class="col-md-8">
                        <textarea id="penjelasan_perkembangan" class="form-control" rows="3" readonly>{{ $perkembangan->penjelasan_perkembangan }}</textarea>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="row mb-3">
                    <label for="catatan" class="col-md-4 col-form-label">Catatan Perkembangan</label>
                    <div class="col-md-8">
                        <input type="text" id="catatan" class="form-control" value="{{ $perkembangan->catatan }}" readonly>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
<script>

    function goToHistory() {
        window.location.href = '/path/to/history';
    }

    function goToMessage() {
        // Mengarahkan pengguna ke halaman pesan
        location.href = "{{ route('pesan.index') }}";
    }
</script>
