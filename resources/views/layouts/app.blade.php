<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sparepart - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; font-family: 'Inter', sans-serif; }
        .navbar { background: #1649a0; }
        .navbar-brand, .nav-link, .dropdown-toggle { color: white !important; }
        .card { border-radius: 15px; transition: 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg px-4">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">SparepartUser</a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('jenis.barang') }}">Jenis Barang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('request.barang') }}">Request Barang</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container my-5">
        @yield('content')
    </div>
</body>
</html>
