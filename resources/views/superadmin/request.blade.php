<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Barang - Superadmin</title>
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
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 2px;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .request-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 15px;
            margin-bottom: 15px;
            transition: var(--transition);
        }
        
        .request-card:hover {
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
            
            .request-card {
                padding: 12px;
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
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
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
                    <a href="{{ route('superadmin.request.index') }}" class="list-group-item list-group-item-action py-3 active">
                        <i class="bi bi-cart-check"></i> Request Barang
                    </a>
                    <a href="{{ route('superadmin.sparepart.index') }}" class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-tools"></i> Daftar Sparepart
                    </a>
                    <a href="{{ route('superadmin.history.index') }}" class="list-group-item list-group-item-action py-3">
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
                            <h4 class="fw-bold mb-0"><i class="bi bi-cart-check me-2"></i>Daftar Request Barang</h4>
                            <p class="text-muted mb-0">Kelola permintaan barang dari berbagai RO</p>
                        </div>
                        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-card">
                    <h5 class="mb-4"><i class="bi bi-funnel me-2"></i>Filter Request</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="statusFilter" class="form-label">Status Request</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu Approval</option>
                                <option value="diproses">Diproses</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="dikirim">Dikirim</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dateFilter" class="form-label">Tanggal Request</label>
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="searchFilter" class="form-label">Cari Request</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari ID atau nama barang..." id="searchFilter">
                                <button class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light me-2">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-filter me-1"></i> Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="request-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-clock-history text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Menunggu</h6>
                                    <h4 class="mb-0 fw-bold text-primary">5</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="request-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-gear text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Diproses</h6>
                                    <h4 class="mb-0 fw-bold text-info">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="request-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Disetujui</h6>
                                    <h4 class="mb-0 fw-bold text-success">12</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="request-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-x-circle text-danger fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Ditolak</h6>
                                    <h4 class="mb-0 fw-bold text-danger">2</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Request</th>
                                    <th>Requester</th>
                                    <th>Barang Diminta</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tanggal Request</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="fw-bold">REQ001</span></td>
                                    <td>Kepala RO 1</td>
                                    <td>Oli Mesin</td>
                                    <td>50</td>
                                    <td><span class="badge bg-warning status-badge">Menunggu Approval</span></td>
                                    <td>2025-08-25</td>
                                    <td>
                                        <button class="btn btn-success btn-action" data-bs-toggle="tooltip" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-danger btn-action" data-bs-toggle="tooltip" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ002</span></td>
                                    <td>Kepala RO 2</td>
                                    <td>Kampas Rem</td>
                                    <td>25</td>
                                    <td><span class="badge bg-info status-badge">Diproses</span></td>
                                    <td>2025-08-24</td>
                                    <td>
                                        <button class="btn btn-success btn-action" data-bs-toggle="tooltip" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-danger btn-action" data-bs-toggle="tooltip" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ003</span></td>
                                    <td>Kepala RO 3</td>
                                    <td>Filter Udara</td>
                                    <td>30</td>
                                    <td><span class="badge bg-success status-badge">Disetujui</span></td>
                                    <td>2025-08-23</td>
                                    <td>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ004</span></td>
                                    <td>Kepala RO 4</td>
                                    <td>Busi</td>
                                    <td>100</td>
                                    <td><span class="badge bg-danger status-badge">Ditolak</span></td>
                                    <td>2025-08-22</td>
                                    <td>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ005</span></td>
                                    <td>Kepala RO 5</td>
                                    <td>Filter Oli</td>
                                    <td>40</td>
                                    <td><span class="badge bg-primary status-badge">Dikirim</span></td>
                                    <td>2025-08-21</td>
                                    <td>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-action" disabled>
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-container d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan 1 hingga 5 dari 22 entri
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
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight menu aktif
            const currentLocation = location.href;
            const menuItems = document.querySelectorAll('.list-group-item');
            const menuLength = menuItems.length;
            
            for (let i = 0; i < menuLength; i++) {
                if (menuItems[i].href === currentLocation) {
                    menuItems[i].classList.add('active');
                }
            }
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Set tanggal default untuk filter
            document.getElementById('dateFilter').valueAsDate = new Date();
        });
    </script>
</body>
</html>