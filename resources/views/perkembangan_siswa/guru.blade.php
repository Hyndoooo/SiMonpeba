@extends('layouts.master')

@section('title', 'Perkembangan Siswa')

@section('content')
<header class="mb-4">
    <h2 class="text-uppercase text-white py-4 px-3" style="text-align: left; font-weight: bold;">
        Perkembangan Siswa
    </h2>
    <link rel="stylesheet" href="{{ asset('css/perkembangan_siswa/guru.css') }}">
</header>

<!-- Tab Navigasi -->
<div class="tabs">
    <ul>
        <!-- Tab Data Siswa -->
        <li id="data-siswa-tab" class="tab {{ request()->routeIs('guru.dashboard') ? '' : '' }}">
            <a href="{{ route('guru.dashboard') }}">Data Siswa</a>
        </li>
    
        <!-- Tab Perkembangan Siswa -->
        <li id="perkembangan-siswa-tab" class="tab {{ request()->routeIs('perkembangan-siswa') ? 'active' : '' }}">
            <a href="{{ route('perkembangan-siswa') }}">Perkembangan Siswa</a>
        </li>
    </ul>    
</div>

<!-- Wrapper untuk menempatkan Search di sebelah kanan -->
<div class="header-wrapper">
    <form action="{{ route('perkembangan-siswa') }}" method="GET" class="search-container">
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
                <!-- Perbaiki path foto profil -->
                <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : asset('images/default-avatar.jpg') }}" alt="Foto Siswa">
                <div class="card-info">
                    <h3>{{ $siswa->nama }}</h3>
                    <p>NIS: {{ $siswa->nis }}</p>
                </div>
            </div>
            <a href="{{ route('perkembangan_siswa.detail', ['nis' => $siswa->nis]) }}" class="btn">Lihat Perkembangan</a>
        </div>
    @empty
        <p>Belum ada data siswa yang tersedia.</p>
    @endforelse
</section>

<!-- Pagination -->
<div class="pagination">
    {{ $dataSiswa->links('pagination::bootstrap-4') }}
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/perkembangan_siswa/guru.js') }}"></script>
<script>
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
