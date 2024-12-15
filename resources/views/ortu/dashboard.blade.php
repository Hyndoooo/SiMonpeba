@extends('layouts.master_user')

@section('title', 'Dashboard Ortu')

@section('content')
<header class="mb-4">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Detail Data Siswa
    </h2>
    <!-- Link ke CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard/ortu.css') }}">
</header>

<div class="tabs">
    <ul>
        <!-- Tab Biodata -->
        <li id="data-siswa-tab" class="tab {{ request()->routeIs('ortu.dashboard') ? 'active' : '' }}">
            <a href="{{ route('ortu.dashboard') }}">Biodata</a>
        </li>
        <!-- Tab Perkembangan -->
        <li id="perkembangan-siswa-tab" class="tab {{ request()->routeIs('ortu.detail') ? 'active' : '' }}">
            <a href="{{ route('ortu.detail', ['nis' => $siswa->nis]) }}">Perkembangan</a>
        </li>
    </ul>
</div>

<div class="outer-container">
    <div class="container card shadow-sm p-4">
        <div class="row">
            <!-- Foto Profil -->
            <div class="col-md-3 text-left">
                <label class="form-label fw-bold">Foto Profil</label>
                <div class="d-flex justify-content-start align-items-center">
                    <div class="foto-profil-wrapper">
                        <div class="foto-profil-container">
                            <img id="previewFoto" 
                            src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : asset('images/default-avatar.jpg') }}" alt="Foto Siswa">
                        </div>
                    </div>
                </div>
                <br>
            </div>

            <!-- Form Biodata -->
            <div class="col-md-9">
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Nomor Induk Siswa</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->nis }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Nama Siswa</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->nama }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Tempat, Tanggal Lahir</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->ttl }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Agama</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->agama }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="3" readonly>{{ $siswa->alamat }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">Orangtua/Wali</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->orangtua_wali }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4 col-form-label">No Telepon</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{ $siswa->no_telepon }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
