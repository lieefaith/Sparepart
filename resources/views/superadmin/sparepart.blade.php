<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sparepart - Superadmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        /* ... CSS Anda di sini ... */
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --light-bg: #f8f9fa;
            --dark-bg: #212529;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #343a40;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background-color: white;
            border-right: 1px solid #e9ecef;
            min-height: calc(100vh - 73px);
            box-shadow: var(--card-shadow);
            padding: 0;
            transition: var(--transition);
        }

        .sidebar .nav-link {
            color: #495057;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: var(--transition);
        }

        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            border-left: 4px solid var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: #e9ecef;
            border-left: 4px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 24px;
            text-align: center;
        }

        .main-content {
            padding: 20px;
            transition: var(--transition);
        }

        .page-header {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 20px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 20px;
            margin-top: 20px;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.25rem;
        }

        .filter-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 20px;
            margin-bottom: 20px;
        }

        .pagination-container {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 15px 20px;
            margin-top: 20px;
        }

        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 2px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 15px;
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .badge-pill {
            border-radius: 10rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }

            .table-responsive {
                font-size: 14px;
            }

            .stats-card {
                padding: 12px;
            }
        }

        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-width: 250px;
            --header-height: 70px;
            --card-border-radius: 12px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #ecf0f1;
            --sidebar-active: #3498db;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
            padding-top: var(--header-height);
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            height: var(--header-height);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--sidebar-bg);
            color: var(--sidebar-color);
            min-height: calc(100vh - var(--header-height));
            width: var(--sidebar-width);
            position: fixed;
            left: 0;
            top: var(--header-height);
            transition: all 0.3s ease;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 900;
        }

        .sidebar .list-group-item {
            background: transparent;
            color: var(--sidebar-color);
            border: none;
            border-left: 4px solid transparent;
            border-radius: 0;
            padding: 1rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--sidebar-active);
        }

        .sidebar .list-group-item.active {
            background: linear-gradient(90deg, rgba(52, 152, 219, 0.2), transparent);
            border-left-color: var(--sidebar-active);
            color: white;
        }

        .sidebar .list-group-item i {
            width: 24px;
            margin-right: 12px;
            transition: all 0.3s;
        }

        .sidebar .list-group-item.active i {
            transform: scale(1.2);
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s;
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .stats-title {
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0;
        }

        /* Table Styling */
        .table-container {
            background: white;
            border-radius: var(--card-border-radius);
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .table-container h5 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.2rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .table th {
            font-weight: 600;
            color: #495057;
            border-top: none;
            border-bottom: 2px solid #f0f0f0;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Pagination */
        .pagination-container {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
            margin-top: 1.5rem;
        }

        /* Status Badge */
        .status-badge {
            padding: 0.5em 0.8em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        /* Button Action */
        .btn-action {
            padding: 0.3rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 2px;
        }

        /* Date Badge */
        .badge-date {
            background: linear-gradient(45deg, var(--primary), var(--info));
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
            color: white;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                text-align: center;
            }

            .sidebar .list-group-item span {
                display: none;
            }

            .sidebar .list-group-item i {
                margin-right: 0;
                font-size: 1.3rem;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .sidebar.show {
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Animation for cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }

        /* Additional improvements */
        .card-icon.bg-primary {
            background-color: rgba(67, 97, 238, 0.1) !important;
        }

        .card-icon.bg-danger {
            background-color: rgba(230, 57, 70, 0.1) !important;
        }

        .card-icon.bg-success {
            background-color: rgba(76, 201, 240, 0.1) !important;
        }

        .card-icon.bg-warning {
            background-color: rgba(247, 37, 133, 0.1) !important;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-danger {
            background-color: var(--danger) !important;
        }

        .bg-success {
            background-color: var(--success) !important;
        }

        .bg-warning {
            background-color: var(--warning) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .text-success {
            color: var(--success) !important;
        }

        .text-warning {
            color: var(--warning) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('superadmin.dashboard') }}">
                <i class="bi bi-gear-fill me-2"></i>
                <span>Superadmin Dashboard</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Superadmin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i
                                        class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 p-0 sidebar">
                <div class="list-group list-group-flush">
                    <a href="{{ route('superadmin.dashboard') }}" class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('superadmin.request.index') }}"
                        class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-cart-check"></i> Request Barang
                    </a>
                    <a href="{{ route('superadmin.sparepart.index') }}"
                        class="list-group-item list-group-item-action py-3 active">
                        <i class="bi bi-tools"></i> Daftar Sparepart
                    </a>
                    <a href="{{ route('superadmin.history.index') }}"
                        class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-clock-history"></i> Histori Barang
                    </a>
                </div>
            </div>

            <div class="col-lg-10 col-md-9 main-content">
                <form method="GET" action="{{ route('superadmin.sparepart.index') }}">
                    <div class="filter-card">
                        <h5 class="mb-4"><i class="bi bi-funnel me-2"></i>Filter Sparepart</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="statusFilter" class="form-label">Status Sparepart</label>
                                <select class="form-select" name="status" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia</option>
                                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis
                                    </option>
                                    <option value="dipesan" {{ request('status') == 'dipesan' ? 'selected' : '' }}>
                                        Dipesan</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="jenisFilter" class="form-label">Jenis Sparepart</label>
                                <select class="form-select" name="jenis" id="jenisFilter"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Jenis</option>
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id }}"
                                            {{ (string) request('jenis') === (string) $j->id ? 'selected' : '' }}>
                                            {{ $j->jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="searchFilter" class="form-label">Cari Sparepart</label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        placeholder="Cari ID atau nama sparepart..." name="search"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('superadmin.sparepart.index') }}" class="btn btn-light me-2">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-filter me-1"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-box-seam text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Sparepart</h6>
                                    <h4 class="mb-0 fw-bold text-primary">{{ $totalQty }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Tersedia</h6>
                                    <h4 class="mb-0 fw-bold text-success">{{ $totalTersedia }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-cart text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Dipesan</h6>
                                    <h4 class="mb-0 fw-bold text-warning">{{ $totalDipesan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-x-circle text-danger fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Habis</h6>
                                    <h4 class="mb-0 fw-bold text-danger">{{ $totalHabis }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Sparepart</th>
                                    <th>Jenis & Type</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>PIC</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listBarang as $barang)
                                    <tr>
                                        <td><span class="fw-bold">{{ $barang->tiket_sparepart }}</span></td>
                                        <td>{{ $barang->jenisBarang->jenis }} {{ $barang->tipeBarang->tipe }}</td>
                                        <td>
                                            <span
                                                class="badge
                                                    @if ($barang->status == 'tersedia') bg-success
                                                    @elseif($barang->status == 'habis') bg-danger
                                                    @elseif($barang->status == 'dipesan') bg-warning
                                                    @else bg-secondary @endif">
                                                {{ ucfirst($barang->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $barang->quantity }}</td>
                                        <td>{{ $barang->pic }}</td>
                                        <td>{{ \Carbon\Carbon::parse($barang->tanggal)->format('d-m-Y') }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-action" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger btn-action" data-bs-toggle="tooltip"
                                                title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm btn-detail"
                                                onclick="showDetail('{{ $barang->tiket_sparepart }}')"
                                                title="Detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $listBarang->firstItem() }} hingga {{ $listBarang->lastItem() }} dari
                        {{ $listBarang->total() }} entri
                    </div>
                    <nav aria-label="Page navigation">
                        {{ $listBarang->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transaksiDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Detail Sparepart</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" id="transaksi-spinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <div id="transaksi-content" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-md-6"><strong>ID Transaksi:</strong> <span id="trx-id"></span></div>
                            <div class="col-md-6"><strong>Tanggal:</strong> <span id="trx-date"></span></div>
                        </div>
                        <h6 class="mt-3 mb-2">Daftar Sparepart:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Serial Number</th>
                                        <th>Type</th>
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <th>Vendor (Supplier)</th>
                                        <th>SPK</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="trx-items-list">
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let transaksiDetailModal;

        document.addEventListener("DOMContentLoaded", function() {
            transaksiDetailModal = new bootstrap.Modal(document.getElementById('transaksiDetailModal'));

            // Memeriksa jika ada error validasi saat halaman dimuat
            @if ($errors->any())
                const modal = new bootstrap.Modal(document.getElementById('tambahSparepartModal'));
                modal.show();
            @endif
        });

        function formatRupiah(val) {
            const num = Number(String(val).replace(/\D/g, '')) || 0;
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
        }

        function showTransaksiDetail(data) {
            document.getElementById('transaksi-spinner').style.display = 'block';
            document.getElementById('transaksi-content').style.display = 'none';

            document.getElementById('trx-id').textContent = data.id || '-';
            document.getElementById('trx-date').textContent = data.tanggal || '-';

            const tbody = document.getElementById('trx-items-list');
            tbody.innerHTML = "";

            data.items.forEach((item, i) => {
                const row = `
            <tr>
                <td>${i + 1}</td>
                <td>${item.serial || '-'}</td>
                <td>${data.type || '-'}</td>
                <td>${data.jenis || '-'}</td>
                <td>${item.harga ? formatRupiah(item.harga) : '-'}</td>
                <td>${item.vendor || '-'}</td>
                <td>${item.spk || '-'}</td>
                <td>${item.keterangan || '-'}</td>
            </tr>
        `;
                tbody.insertAdjacentHTML("beforeend", row);
            });

            document.getElementById('transaksi-spinner').style.display = 'none';
            document.getElementById('transaksi-content').style.display = 'block';
            transaksiDetailModal.show();
        }

        function showDetail(tiket_sparepart) {
            fetch(`/superadmin/sparepart/${tiket_sparepart}/detail`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    showTransaksiDetail(data);
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    alert('Gagal mengambil detail!');
                });
        }
    </script>
</body>
</html>