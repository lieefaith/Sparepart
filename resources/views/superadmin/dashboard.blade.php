<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin</title>
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
        
        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: none;
            height: 100%;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stats-number {
            font-size: 28px;
            font-weight: 700;
        }
        
        .stats-title {
            font-size: 14px;
            color: #6c757d;
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
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .status-badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            
            .stats-number {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
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
                    <a href="{{ route('superadmin.dashboard') }}" class="list-group-item list-group-item-action py-3 active">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('superadmin.request.index') }}" class="list-group-item list-group-item-action py-3">
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold">Dashboard Overview</h3>
                    <div>
                        <span class="badge bg-light text-dark"><i class="bi bi-calendar me-1"></i> <?php echo date('d F Y'); ?></span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-card p-4">
                            <div class="card-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <h4 class="stats-number">12</h4>
                            <p class="stats-title">Request Barang Baru</p>
                            <div class="d-flex align-items-center">                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-card p-4">
                            <div class="card-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-tools"></i>
                            </div>
                            <h4 class="stats-number">156</h4>
                            <p class="stats-title">Total Sparepart</p>
                            <div class="d-flex align-items-center">                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-card p-4">
                            <div class="card-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h4 class="stats-number">42</h4>
                            <p class="stats-title">Transaksi Hari Ini</p>
                            <div class="d-flex align-items-center">                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-card p-4">
                            <div class="card-icon bg-info bg-opacity-10 text-info">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h4 class="stats-number">5</h4>
                            <p class="stats-title">User Aktif</p>
                            <div class="d-flex align-items-center">                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="table-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Request Terbaru</h5>
                                <a href="{{ route('superadmin.request.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Request</th>
                                            <th>Requester</th>
                                            <th>Barang Diminta</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>REQ001</td>
                                            <td>RO Batam</td>
                                            <td>Oli Mesin</td>
                                            <td><span class="badge bg-warning status-badge">Menunggu</span></td>
                                        </tr>
                                        <tr>
                                            <td>REQ002</td>
                                            <td>RO Bekasi</td>
                                            <td>Kampas Rem</td>
                                            <td><span class="badge bg-info status-badge">Diproses</span></td>
                                        </tr>
                                        <tr>
                                            <td>REQ003</td>
                                            <td>RO Jambi</td>
                                            <td>Filter Udara</td>
                                            <td><span class="badge bg-success status-badge">Disetujui</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="table-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Stok Sparepart</h5>
                                <a href="{{ route('superadmin.sparepart.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sparepart</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kampas Rem</td>
                                            <td>120</td>
                                            <td><span class="badge bg-success status-badge">Tersedia</span></td>
                                        </tr>
                                        <tr>
                                            <td>Oli Mesin</td>
                                            <td>85</td>
                                            <td><span class="badge bg-success status-badge">Tersedia</span></td>
                                        </tr>
                                        <tr>
                                            <td>Filter Oli</td>
                                            <td>12</td>
                                            <td><span class="badge bg-warning status-badge">Hampir Habis</span></td>
                                        </tr>
                                        <tr>
                                            <td>Busi</td>
                                            <td>5</td>
                                            <td><span class="badge bg-danger status-badge">Habis</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple JavaScript untuk interaktivitas
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
            
            // Animasi untuk card stats
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 15px rgba(0, 0, 0, 0.1)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                });
            });
        });
    </script>
</body>
</html>