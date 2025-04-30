@extends('layouts.master')

@section('title', 'Dashboard Guru')

@section('content')
<header class="mb-4">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Data Siswa
    </h2>
    <link rel="stylesheet" href="{{ asset('css/dashboard/guru.css') }}">
</header>

<!-- Tab Navigasi -->
<div class="tabs">
    <ul>
        <li id="data-siswa-tab" class="tab {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
            <a href="{{ route('guru.dashboard') }}">Data Siswa</a>
        </li>
        <li id="perkembangan-siswa-tab" class="tab {{ request()->routeIs('perkembangan-siswa') ? 'active' : '' }}">
            <a href="{{ route('perkembangan-siswa') }}">Perkembangan Siswa</a>
        </li>
    </ul>
</div>

<!-- Wrapper untuk menempatkan Search di sebelah kanan -->
<div class="header-wrapper">
    <form action="{{ route('guru.dashboard') }}" method="GET" class="search-container">
        <input 
            type="text" 
            name="search" 
            placeholder="Cari Siswa..." 
            class="search-box" 
            value="{{ request('search') }}" 
        >
        <button type="submit" class="search-btn">Cari</button>
    </form>
</div>

<!-- Cards untuk data siswa -->
<section class="cards">
    @forelse($dataSiswa as $siswa)
        <div class="card">
            <div class="card-content">
                <!-- Menampilkan foto profil siswa, jika tidak ada, tampilkan foto default -->
                <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : asset('images/default-avatar.jpg') }}" alt="Foto Siswa">
                <div class="card-info">
                    <h3>{{ $siswa->nama }}</h3>
                    <p>NIS: {{ $siswa->nis }}</p>
                    <p>Kelas: {{ $siswa->kelas }}</p>
                </div>
            </div>
            <!-- Tombol Selengkapnya yang mengarah ke halaman detail siswa -->
            <a href="{{ route('data_siswa.detail', ['nis' => $siswa->nis]) }}" class="btn">Selengkapnya</a>
        </div>
    @empty
        <p>Belum ada data siswa yang tersedia.</p>
    @endforelse
</section>

<!-- Card Tambah -->
<div class="card add-card">
    <a href="{{ route('data_siswa.create') }}">
        <img src="{{ asset('images/tambah.png') }}" alt="Tambah">
        <h3>Tambah Siswa</h3>
    </a>
</div>

<!-- Pagination -->
<div class="pagination">
    {{ $dataSiswa->links('pagination::bootstrap-4') }}
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/dashboard/guru.js') }}"></script>
<script>
    // Fungsi untuk berpindah antar tab
    function switchTab(tabName) {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active');
        });

        const selectedTab = document.getElementById(tabName + '-tab');
        selectedTab.classList.add('active');

        const underline = document.getElementById('underline');
        setTimeout(() => {
            underline.style.left = selectedTab.offsetLeft + 'px';
            underline.style.width = selectedTab.offsetWidth + 'px';
        }, 100);
    }

    // Fungsi untuk preview gambar saat upload
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

    // Menambahkan animasi underline pada tab aktif saat halaman dimuat
    window.onload = function() {
        const activeTab = document.querySelector('.tab.active');
        const underline = document.getElementById('underline');
        setTimeout(() => {
            underline.style.left = activeTab.offsetLeft + 'px';
            underline.style.width = activeTab.offsetWidth + 'px';
        }, 100);
    };
</script>
@endsection
