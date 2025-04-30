@extends('layouts.master')

@section('title', 'Tambah Data Siswa')

@section('content')
<header class="mb-4">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Tambah Data Siswa
    </h2>
    <link rel="stylesheet" href="{{ asset('css/data_siswa/create.css') }}">
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
            <!-- Foto Profil -->
            <div class="col-md-3 text-left">
                <label class="form-label fw-bold">Foto Profil</label>
                <div class="d-flex justify-content-start align-items-center">
                    <!-- Border Foto Profil -->
                    <div class="foto-profil-wrapper">
                        <div class="foto-profil-container">
                            <!-- Ganti src agar mendukung preview dari server -->
                            <img id="previewFoto" 
                                src="{{ old('foto_profil') ? asset('uploads/foto_siswa/' . old('foto_profil')) : asset('images/tambah_foto.png') }}" 
                                alt="Foto Profil" 
                                onclick="document.getElementById('foto_profil').click();">
                            <i id="iconUpload" class="fas fa-upload"></i>
                            <form action="{{ route('data_siswa.store') }}" method="POST" enctype="multipart/form-data">
                        </div>
                    </div>                    
                    <input type="file" id="foto_profil" name="foto_profil" style="display:none" accept="image/*" onchange="previewFoto(this)">
                </div>
                <br>
            </div>

            <!-- Form Input -->
            <div class="col-md-9">
                    @csrf
                    <div class="row mb-3">
                        <label for="nis" class="col-md-4 col-form-label">Nomor Induk Siswa</label>
                        <div class="col-md-8">
                            <input type="text" id="nis" name="nis" 
                                class="form-control @error('nis') is-invalid @enderror" 
                                value="{{ old('nis') }}" required>
                            @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-md-4 col-form-label">Nama Siswa</label>
                        <div class="col-md-8">
                            <input type="text" id="nama" name="nama" 
                                class="form-control @error('nama') is-invalid @enderror" 
                                value="{{ old('nama') }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kelas" class="col-md-4 col-form-label">Kelas</label>
                        <div class="col-md-8">
                            <input type="text" id="kelas" name="kelas" 
                                class="form-control @error('kelas') is-invalid @enderror" 
                                value="{{ old('kelas') }}" required>
                            @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ttl" class="col-md-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="date" id="ttl" name="ttl" 
                                class="form-control @error('ttl') is-invalid @enderror" 
                                value="{{ old('ttl') }}" required>
                            @error('ttl')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="agama" class="col-md-4 col-form-label">Agama</label>
                        <div class="col-md-8">
                            <select id="agama" name="agama" 
                                    class="form-select @error('agama') is-invalid @enderror" required>
                                <option value="" selected>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea id="alamat" name="alamat" 
                                    class="form-control @error('alamat') is-invalid @enderror" 
                                    required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="orangtua_wali" class="col-md-4 col-form-label">Orangtua/Wali</label>
                        <div class="col-md-8">
                            <input type="text" id="orangtua_wali" name="orangtua_wali" 
                                class="form-control @error('orangtua_wali') is-invalid @enderror" 
                                value="{{ old('orangtua_wali') }}" required>
                            @error('orangtua_wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="no_telepon" class="col-md-4 col-form-label">No. Telepon</label>
                        <div class="col-md-8">
                            <input type="text" id="no_telepon" name="no_telepon" 
                                class="form-control @error('no_telepon') is-invalid @enderror" 
                                value="{{ old('no_telepon') }}" required>
                            @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
</script>
