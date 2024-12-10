@extends('layouts.master')

@section('title', 'Detail Perkembangan Siswa')

@section('content')
<header class="mb-4" style="background-color: #1AABA5; position: relative;">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Detail Perkembangan Siswa
    </h2>
    <div class="header-buttons">
        <!-- Button HISTORI -->
        <button class="btn-icon" onclick="location.href='{{ route('histori.index', ['nis' => $siswa->nis]) }}'">
            <i class="fas fa-history"></i> HISTORI
        </button>
        <!-- Button PESAN -->
        <button class="btn-icon" onclick="goToMessage()">
            <i class="fas fa-envelope"></i> PESAN
        </button>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/detail.css') }}">
</header>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="outer-container">
    <div class="container card shadow-sm p-4">
        <div class="row">
            <!-- Bukti media -->
            <div class="col-md-3 text-left">
                <label class="form-label fw-bold">Bukti Media</label>
                <div class="d-flex justify-content-start align-items-center">
                    <div class="foto-profil-wrapper">
                        <div class="foto-profil-container">
                            <img id="previewFoto" 
                                src="{{ asset('images/tambah_foto.png') }}" 
                                alt="Bukti Media" 
                                onclick="document.getElementById('bukti_media').click();">
                            <i id="iconUpload" class="fas fa-upload"></i>
                        </div>
                    </div>                    
                    <input type="file" id="bukti_media" name="bukti_media" style="display:none" accept="image/*" onchange="previewFoto(this)">
                </div>
                <br>
            </div>

            <!-- Form Input -->
            <div class="col-md-9">
                <form action="{{ route('perkembangan_siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Waktu -->
                    <div class="row mb-3">
                        <label for="waktu" class="col-md-4 col-form-label">Waktu</label>
                        <div class="col-md-8">
                            <input type="date" id="waktu" name="waktu" class="form-control" required>
                        </div>
                    </div>

                    <!-- NIS -->
                    <div class="row mb-3">
                        <label for="nis" class="col-md-4 col-form-label">Nomor Induk Siswa</label>
                        <div class="col-md-8">
                            <input type="text" id="nis" name="nis" 
                                class="form-control @error('nis') is-invalid @enderror" 
                                value="{{ old('nis', $siswa->nis) }}" readonly>
                        </div>
                    </div>

                    <!-- Nama -->
                    <div class="row mb-3">
                        <label for="nama" class="col-md-4 col-form-label">Nama Siswa</label>
                        <div class="col-md-8">
                            <input type="text" id="nama" name="nama" 
                                class="form-control @error('nama') is-invalid @enderror" 
                                value="{{ old('nama', $siswa->nama) }}" readonly>
                        </div>
                    </div>

                    <!-- Jadwal Pelajaran -->
                    <div class="row mb-3">
                        <label for="jadwal_pelajaran" class="col-md-4 col-form-label">Jadwal Pelajaran</label>
                        <div class="col-md-8">
                            <select id="jadwal_pelajaran" name="jadwal_pelajaran" class="form-select" required>
                                <option value="" selected>Pilih Jadwal Pelajaran</option>
                                <option value="Pengembangan Jati Diri">Pengembangan Jati Diri</option>
                                <option value="Nilai Agama">Nilai Agama</option>
                                <option value="Budipekerti">Budipekerti</option>
                                <option value="Literasi">Literasi</option>
                            </select>
                        </div>
                    </div>

                    <!-- Penjelasan Perkembangan -->
                    <div class="row mb-3">
                        <label for="penjelasan_perkembangan" class="col-md-4 col-form-label">Detail Perkembangan</label>
                        <div class="col-md-8">
                            <textarea id="penjelasan_perkembangan" name="penjelasan_perkembangan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="row mb-3">
                        <label for="catatan" class="col-md-4 col-form-label">Catatan Perkembangan</label>
                        <div class="col-md-8">
                            <input type="text" id="catatan" name="catatan" class="form-control" value="" required>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    // Preview Foto
    function previewFoto(input) {
        const preview = document.getElementById('previewFoto');
        const icon = document.getElementById('iconUpload');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                icon.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function goToHistory() {
        window.location.href = '/path/to/history';
    }

    function goToMessage() {
        // Mengarahkan pengguna ke halaman pesan
        location.href = "{{ route('pesan.index') }}";
    }
</script>
