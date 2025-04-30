@extends('layouts.master_user')

@section('title', 'Bukti Perkembangan Belajar Siswa')

@section('content')
    <!-- Header -->
    <header class="mb-4">
        <h2 class="text-uppercase text-white py-4 px-3">
            Bukti Perkembangan Belajar Siswa
        </h2>
        <!-- Link ke CSS -->
        <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/bukti_media.css') }}">
    </header>

<div class="outer-container">
    <div class="container card shadow-sm p-4">
        <!-- Media Wrapper -->
        <div class="media-wrapper">
            <!-- Gambar Bukti Media -->
            <div class="image-container">
                <img src="{{ asset('storage/' . $perkembangan->bukti_media) }}" alt="Bukti Media" class="img-fluid">
            </div>
        </div>

        <!-- Button Kembali dan Unduh -->
        <div class="buttons-container">
            <a href="{{ route('ortu.detail', ['nis' => $siswa->nis]) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('ortu.download.bukti', ['nis' => $siswa->nis]) }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Unduh
            </a>
        </div>
    </div>
</div>
@endsection
