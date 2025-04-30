<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiMonpeba</title>
    <style>
        /* Reset CSS */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #1AABA5;
            height: 60px;
            padding: 0 20px;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 10;
        }
        .header .logo-container {
            display: inline-flex;
            align-items: center;
        }
        .header .logo img {
            height: 160px;
            transition: height 0.3s ease;
        }
        .menu-toggle-wrapper {
            background-color: #16B3AC;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 30px;
            transition: padding 0.3s ease;
        }
        .menu-toggle div {
            width: 20px;
            height: 2px;
            background-color: white;
            margin: 3px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .menu-toggle.active div:nth-child(1) {
            transform: rotate(45deg);
            top: 6px;
        }
        .menu-toggle.active div:nth-child(2) {
            opacity: 0;
        }
        .menu-toggle.active div:nth-child(3) {
            transform: rotate(-45deg);
            top: -6px;
        }
        .header .profile-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100% - 60px);
            background-color: #1AABA5;
            padding: 20px;
            color: white;
            transform: translateX(-250px);
            transition: transform 0.3s ease;
        }
        .sidebar.active {
            transform: translateX(0);
        }
        .sidebar a {
            display: flex;
            align-items: center;
            margin: 15px 0;
            color: #000000;
            text-decoration: none;
            font-size: 18px;
            background-color: #D9D9D9;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .sidebar a img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #D9D9D9;
            color: #000000;
            transform: scale(1.05);
        }
        .sidebar a:hover img {
            transform: scale(1.2);
        }

        .sidebar .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 60px;
        }
        .sidebar .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin-bottom: 10px;
        }
        .sidebar .profile h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .sidebar .profile p {
            font-size: 14px;
            color: white;
        }

        /* Main Content */
        main {
            margin-left: 0;
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.active + main {
            margin-left: 250px;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .header .logo img {
                height: 80px;
            }

            .sidebar {
                width: 200px;
            }

            main {
                margin-left: 0;
            }

            .sidebar a {
                font-size: 16px;
                padding: 10px 15px;
            }
        }
    </style>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/simonpeba.png') }}" alt="Logo SiMonpeba">
            </div>
            <div class="menu-toggle-wrapper" onclick="toggleSidebar()">
                <div class="menu-toggle">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="profile-header">
            <img src="{{ Auth::user()->guru && Auth::user()->guru->foto_profil 
                        ? asset('storage/' . Auth::user()->guru->foto_profil) 
                        : asset('images/default-avatar.jpg') }}" 
                alt="Profile Picture">
        </div>        
    </header>

    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="{{ Auth::user()->guru && Auth::user()->guru->foto_profil 
                        ? asset('storage/' . Auth::user()->guru->foto_profil) 
                        : asset('images/default-avatar.jpg') }}" 
                alt="Profile Picture">
            <h2 style="text-align: center;">{{ Auth::user()->guru ? Auth::user()->guru->nama : 'Nama tidak tersedia' }}</h2>
            <p>{{ Auth::user()->guru ? Auth::user()->guru->nip : 'NIP tidak tersedia' }}</p>
        </div>
        <!-- Dashboard Button -->
        <a href="{{ route('guru.dashboard') }}">
            <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard Icon">
            Dashboard
        </a>
        <!-- Logout Button with SweetAlert Confirmation -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form" id="logout-form">
            @csrf
            @method('POST')
            <a href="javascript:void(0);" onclick="confirmLogout()">
                <img src="{{ asset('images/keluar.png') }}" alt="Logout Icon">
                Keluar
            </a>
        </form>
    </div>

    <main>
        @yield('content')
    </main>

    <script>
        // Membuka sidebar secara default saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.add('active');
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            sidebar.classList.toggle('active');
            menuToggle.classList.toggle('active');
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                text: "Anda akan diarahkan keluar dari sistem.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form logout
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>