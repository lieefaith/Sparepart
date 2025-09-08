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

        /* Custom Alert Styles */
        .custom-alert {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateX(100px);
            transition: opacity 0.5s, transform 0.5s;
        }

        .custom-alert.show {
            opacity: 1;
            transform: translateX(0);
        }

        .alert-success-custom {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
        }

        .alert-danger-custom {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
            color: #721c24;
        }

        .modal-confirm {
            color: #434e65;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 15px;
            border: none;
        }

        .modal-confirm .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-bottom: none;
            position: relative;
            text-align: center;
            margin: -20px -20px 0;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .modal-confirm .modal-header h4 {
            text-align: center;
            font-size: 24px;
            margin: 0;
            color: white;
        }

        .modal-confirm .close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            text-shadow: none;
            opacity: 0.8;
        }

        .modal-confirm .close:hover {
            opacity: 1;
        }

        .modal-confirm .icon-box {
            color: #fff;
            width: 75px;
            height: 75px;
            display: inline-block;
            border-radius: 50%;
            z-index: 9;
            border: 5px solid #fff;
            padding: 15px;
            text-align: center;
            margin-top: -45px;
        }

        .modal-confirm .icon-box.success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .modal-confirm .icon-box.warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }

        .modal-confirm .icon-box.danger {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
        }

        .modal-confirm .icon-box i {
            font-size: 2rem;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border: none;
            padding: 10px 20px;
        }

        .modal-confirm .btn:hover,
        .modal-confirm .btn:focus {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            outline: none;
        }

        .modal-confirm .btn-danger {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: linear-gradient(135deg, #c82333, #dc3545);
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }

        /* Validation styles */
        .was-validated .form-control:invalid, .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-feedback {
            display: block;
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

            .custom-alert {
                left: 10px;
                right: 10px;
                min-width: auto;
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
        
        /* Card Styling */
        .card {
            border: none;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background: linear-gradient(120deg, #f8f9fa, #e9ecef);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
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
            background-color: #f8f9fa;
        }
        
        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
        }
        
        /* Badge Styling */
        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
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
            
            .table-responsive {
                font-size: 0.875rem;
            }
        }
        
        /* Animation for cards */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card {
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
        .page-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        
        .action-buttons .btn {
            margin-right: 0.5rem;
        }
        
        .action-buttons .btn:last-child {
            margin-right: 0;
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
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
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
                        class="list-group-item list-group-item-action py-3 active">
                        <i class="bi bi-cart-check"></i> Request Barang
                    </a>
                    <a href="{{ route('superadmin.sparepart.index') }}"
                        class="list-group-item list-group-item-action py-3">
                        <i class="bi bi-tools"></i> Daftar Sparepart
                    </a>
                    <a href="{{ route('superadmin.history.index') }}"
                        class="list-group-item list-group-item-action py-3">
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
                                <input type="text" class="form-control" placeholder="Cari ID atau nama barang..."
                                    id="searchFilter">
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
                    <div class="col-md-4">
                        <div class="request-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-clock-history text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Pending</h6>
                                    <h4 class="mb-0 fw-bold text-warning">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                                    <td>RO Batam</td>
                                    <td>Oli Mesin</td>
                                    <td>50</td>
                                    <td><span class="badge bg-warning status-badge">Menunggu Approval</span></td>
                                    <td>2025-08-25</td>
                                    <td>
                                        <button class="btn btn-success btn-action" onclick="showApproveConfirm('REQ001')"
                                            data-bs-toggle="tooltip" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-danger btn-action" onclick="showRejectConfirm('REQ001')"
                                            data-bs-toggle="tooltip" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" onclick="showRequestDetail('REQ001')"
                                            data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ002</span></td>
                                    <td>RO Bekasi</td>
                                    <td>Kampas Rem</td>
                                    <td>25</td>
                                    <td><span class="badge bg-info status-badge">Diproses</span></td>
                                    <td>2025-08-24</td>
                                    <td>
                                        <button class="btn btn-success btn-action" onclick="showApproveConfirm('REQ002')"
                                            data-bs-toggle="tooltip" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                        <button class="btn btn-danger btn-action" onclick="showRejectConfirm('REQ002')"
                                            data-bs-toggle="tooltip" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <button class="btn btn-info btn-action" onclick="showRequestDetail('REQ002')"
                                            data-bs-toggle="tooltip" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">REQ003</span></td>
                                    <td>RO Jambi</td>
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
                                        <button class="btn btn-info btn-action" onclick="showRequestDetail('REQ003')"
                                            data-bs-toggle="tooltip" title="Detail">
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

    <!-- Modal Detail Request -->
    <div class="modal fade" id="requestDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-eye me-2"></i> Detail Request Barang</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6"><strong>ID Request:</strong> <span id="detail-id"></span></div>
                        <div class="col-md-6"><strong>Tanggal:</strong> <span id="detail-tanggal"></span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Requester:</strong> <span id="detail-requester"></span></div>
                        <div class="col-md-6"><strong>Status:</strong> <span id="detail-status"></span></div>
                    </div>
                    <h6 class="mt-3 mb-2">Barang Diminta:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detail-items">
                                <!-- Diisi via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Approve -->
    <div id="approveConfirmModal" class="modal fade modal-confirm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">Konfirmasi Persetujuan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div class="icon-box success">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <p class="mt-3" id="approveConfirmText">Apakah Anda yakin ingin menyetujui request ini?</p>
                    <input type="hidden" id="requestIdToApprove">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="processApprove()">Ya, Setujui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Reject -->
    <div id="rejectConfirmModal" class="modal fade modal-confirm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">Konfirmasi Penolakan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div class="icon-box danger">
                        <i class="bi bi-x-lg"></i>
                    </div>
                    <p class="mt-3" id="rejectConfirmText">Apakah Anda yakin ingin menolak request ini?</p>
                    <div class="form-group mt-3 text-start">
                        <label for="rejectReason" class="form-label">Alasan Penolakan <span class="text-danger">*</span>:</label>
                        <textarea class="form-control" id="rejectReason" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
                        <div class="invalid-feedback">Alasan penolakan harus diisi.</div>
                    </div>
                    <input type="hidden" id="requestIdToReject">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="validateRejectForm()">Ya, Tolak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert Container -->
    <div id="customAlert" class="custom-alert" style="display: none;">
        <div class="d-flex align-items-center p-3">
            <i class="bi me-3 fs-4" id="alertIcon"></i>
            <div>
                <h6 class="mb-0 fw-bold" id="alertTitle"></h6>
                <p class="mb-0" id="alertMessage"></p>
            </div>
            <button type="button" class="btn-close ms-auto" onclick="hideAlert()"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Contoh data dummy request
        const requestData = {
            "REQ001": {
                id: "REQ001",
                tanggal: "2025-08-25",
                requester: "RO Batam",
                status: "Menunggu Approval",
                items: [
                    { nama: "Oli Mesin", jumlah: 50, ket: "Untuk service bulanan" }
                ]
            },
            "REQ002": {
                id: "REQ002",
                tanggal: "2025-07-15",
                requester: "RO Bekasi",
                status: "Menunggu Approval",
                items: [
                    { nama: "Ban Samping", jumlah: 70, ket: "Untuk service mingguan" }
                ]
            },
            "REQ003": {
                id: "REQ003",
                tanggal: "2025-09-24",
                requester: "RO Jambi",
                status: "Disetujui",
                items: [
                    { nama: "Spakbor", jumlah: 5, ket: "Untuk Motor VIP" }
                ]
            }
        };

        // Fungsi untuk menampilkan konfirmasi approve
        function showApproveConfirm(id) {
            document.getElementById('requestIdToApprove').value = id;
            document.getElementById('approveConfirmText').textContent = 
                `Apakah Anda yakin ingin menyetujui request ${id}?`;
            
            const approveModal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
            approveModal.show();
        }

        // Fungsi untuk menampilkan konfirmasi reject
        function showRejectConfirm(id) {
            document.getElementById('requestIdToReject').value = id;
            document.getElementById('rejectConfirmText').textContent = 
                `Apakah Anda yakin ingin menolak request ${id}?`;
            document.getElementById('rejectReason').value = '';
            
            // Reset validasi
            document.getElementById('rejectReason').classList.remove('is-invalid');
            
            const rejectModal = new bootstrap.Modal(document.getElementById('rejectConfirmModal'));
            rejectModal.show();
        }

        // Validasi form penolakan
        function validateRejectForm() {
            const reasonInput = document.getElementById('rejectReason');
            
            if (!reasonInput.value.trim()) {
                reasonInput.classList.add('is-invalid');
                return false;
            }
            
            reasonInput.classList.remove('is-invalid');
            processReject();
            return true;
        }

        // Fungsi untuk memproses approve
        function processApprove() {
            const id = document.getElementById('requestIdToApprove').value;
            
            // Tutup modal konfirmasi
            bootstrap.Modal.getInstance(document.getElementById('approveConfirmModal')).hide();
            
            // Tampilkan alert sukses
            showAlert('success', 'Request Disetujui', `Request ${id} berhasil disetujui`);
            
            // Di sini bisa tambah AJAX / fetch ke backend
            console.log(`Request ${id} approved`);
        }

        // Fungsi untuk memproses reject
        function processReject() {
            const id = document.getElementById('requestIdToReject').value;
            const reason = document.getElementById('rejectReason').value;
            
            // Tutup modal konfirmasi
            bootstrap.Modal.getInstance(document.getElementById('rejectConfirmModal')).hide();
            
            // Tampilkan alert (tanpa menampilkan alasan)
            showAlert('danger', 'Request Ditolak', `Request ${id} berhasil ditolak `);
            
            // Di sini bisa tambah AJAX / fetch ke backend
            console.log(`Request ${id} rejected`, reason ? `Reason: ${reason}` : '');
        }

        // Fungsi untuk menampilkan alert notifikasi
        function showAlert(type, title, message) {
            const alert = document.getElementById('customAlert');
            const alertIcon = document.getElementById('alertIcon');
            const alertTitle = document.getElementById('alertTitle');
            const alertMessage = document.getElementById('alertMessage');
            
            // Set kelas dan konten berdasarkan jenis alert
            if (type === 'success') {
                alert.className = 'custom-alert alert-success-custom';
                alertIcon.className = 'bi bi-check-circle-fill text-success';
            } else if (type === 'danger') {
                alert.className = 'custom-alert alert-danger-custom';
                alertIcon.className = 'bi bi-x-circle-fill text-danger';
            }
            
            alertTitle.textContent = title;
            alertMessage.textContent = message;
            
            // Tampilkan alert dengan animasi
            alert.style.display = 'block';
            setTimeout(() => {
                alert.classList.add('show');
            }, 10);
            
            // Sembunyikan otomatis setelah 5 detik
            setTimeout(hideAlert, 5000);
        }

        // Fungsi untuk menyembunyikan alert
        function hideAlert() {
            const alert = document.getElementById('customAlert');
            alert.classList.remove('show');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }

        // Fungsi tampilkan detail
        function showRequestDetail(id) {
            const data = requestData[id];
            if (!data) return;

            document.getElementById("detail-id").textContent = data.id;
            document.getElementById("detail-tanggal").textContent = data.tanggal;
            document.getElementById("detail-requester").textContent = data.requester;
            document.getElementById("detail-status").textContent = data.status;

            const tbody = document.getElementById("detail-items");
            tbody.innerHTML = "";
            data.items.forEach((item, i) => {
                tbody.insertAdjacentHTML("beforeend", `
            <tr>
                <td>${i + 1}</td>
                <td>${item.nama}</td>
                <td>${item.jumlah}</td>
                <td>${item.ket}</td>
            </tr>
        `);
            });

            new bootstrap.Modal(document.getElementById("requestDetailModal")).show();
        }

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