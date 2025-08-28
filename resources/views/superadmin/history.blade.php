<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Barang - Superadmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
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

        .btn-export {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            transition: var(--transition);
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
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
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                        class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-tools"></i> Daftar Sparepart
                    </a>
                    <a href="{{ route('superadmin.history.index') }}"
                        class="list-group-item list-group-item-action py-3 active">
                        <i class="bi bi-clock-history"></i> Histori Barang
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 main-content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Histori Barang</h4>
                            <p class="text-muted mb-0">Riwayat transaksi dan pergerakan barang</p>
                        </div>
                        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-card">
                    <h5 class="mb-4"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="dateFrom" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="dateFrom">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dateTo" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="dateTo">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="statusFilter" class="form-label">Status</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="diterima">Diterima</option>
                                <option value="diproses">Diproses</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="jenisFilter" class="form-label">Jenis</label>
                            <select class="form-select" id="jenisFilter">
                                <option value="">Semua Jenis</option>
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light me-2">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Export Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-export">
                        <i class="bi bi-download me-1"></i> Export Data
                    </button>
                </div>

                <!-- Table -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="fw-bold">HIST001</span></td>
                                    <td>RO BATAM</td>
                                    <td><span class="badge bg-success status-badge">Dikirim</span></td>
                                    <td>2025-08-25</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailModal1">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Detail Transaksi -->
                <div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModalLabel1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel1">Detail Transaksi HIST001</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="transaksiTab1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="request-tab1" data-bs-toggle="tab"
                                            data-bs-target="#request1" type="button" role="tab">Form Request</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pengiriman-tab1" data-bs-toggle="tab"
                                            data-bs-target="#pengiriman1" type="button" role="tab">Form
                                            Pengiriman</button>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content mt-3">
                                    <!-- Form Request -->
                                    <div class="tab-pane fade show active" id="request1" role="tabpanel">
                                        <form>
                                            <div class="mb-3">
                                                <label for="barangRequest1" class="form-label">Barang</label>
                                                <input type="text" class="form-control" id="barangRequest1"
                                                    value="Filter Oli" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlahRequest1" class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" id="jumlahRequest1"
                                                    value="50">
                                            </div>
                                            <div class="mb-3">
                                                <label for="keteranganRequest1" class="form-label">Keterangan</label>
                                                <textarea class="form-control"
                                                    id="keteranganRequest1">Request untuk maintenance</textarea>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Form Pengiriman -->
                                    <div class="tab-pane fade" id="pengiriman1" role="tabpanel">
                                        <form>
                                            <div class="mb-3">
                                                <label for="statusPengiriman1" class="form-label">Status
                                                    Pengiriman</label>
                                                <select class="form-select" id="statusPengiriman1">
                                                    <option selected>Dikirim</option>
                                                    <option>Dalam Perjalanan</option>
                                                    <option>Sampai</option>
                                                    <option>Ditolak</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggalKirim1" class="form-label">Tanggal Kirim</label>
                                                <input type="date" class="form-control" id="tanggalKirim1"
                                                    value="2025-08-25">
                                            </div>
                                            <div class="mb-3">
                                                <label for="catatanPengiriman1" class="form-label">Catatan</label>
                                                <textarea class="form-control"
                                                    id="catatanPengiriman1">Pengiriman sesuai jadwal</textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Pagination -->
                <div class="pagination-container d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan 1 hingga 5 dari 25 entri
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Selanjutnya</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Highlight menu aktif
            const currentLocation = location.href;
            const menuItems = document.querySelectorAll('.list-group-item');
            const menuLength = menuItems.length;

            for (let i = 0; i < menuLength; i++) {
                if (menuItems[i].href === currentLocation) {
                    menuItems[i].classList.add('active');
                }
            }

            // Set tanggal default untuk filter
            const today = new Date();
            const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            document.getElementById('dateFrom').valueAsDate = firstDayOfMonth;
            document.getElementById('dateTo').valueAsDate = today;
        });
    </script>
</body>

</html>