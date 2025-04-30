<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiMonpeba</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Wrapper untuk membagi layout menjadi dua bagian -->
    <div class="wrapper">
        <!-- Bagian atas (warna hijau) -->
        <div class="top-section">
            <img src="{{ asset('images/SiMonpeba.png') }}" alt="Logo SiMonpeba" class="logo" />
        </div>

        <!-- Bagian bawah (warna putih, tempat form login) -->
        <div class="bottom-section">
            <!-- Form dalam box putih -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h2 class="form-header">Masuk</h2>

                <!-- Input Username -->
                <div class="input-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" placeholder="Masukan Username Anda"
                        value="{{ old('username') }}" required autofocus />
                    @error('username')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="input-group mt-4">
                    <label for="password">Kata Sandi</label>
                    <input id="password" type="password" name="password" placeholder="Masukan Kata Sandi" required />
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Masuk -->
                <div class="mt-4">
                    <button type="submit" class="login-button">
                        MASUK
                    </button>
                </div>
            </form>
        </div>
    </div>
</html>
