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
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-width: 280px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #ecf0f1;
            --sidebar-active: #3498db;
            --card-border-radius: 12px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--sidebar-bg);
            color: var(--sidebar-color);
            min-height: 100vh;
            width: var(--sidebar-width);
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s ease;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1.5rem 1.5rem 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            color: white;
        }

        .sidebar-header h4 i {
            font-size: 1.8rem;
            margin-right: 10px;
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
            position: relative;
            overflow: hidden;
        }

        .sidebar .list-group-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .sidebar .list-group-item:hover::before {
            left: 100%;
        }

        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: var(--sidebar-active);
            padding-left: 2rem;
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
            transform: scale(1.1);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            transition: all 0.3s;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        .user-info:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--info));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .user-info:hover .user-avatar {
            transform: scale(1.1);
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .logout-btn {
            background: linear-gradient(45deg, var(--danger), #ff6b6b);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 15px;
            width: 100%;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(230, 57, 70, 0.3);
        }

        .logout-btn i {
            margin-right: 8px;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s;
            min-height: 100vh;
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
            height: 100%;
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

        /* Date Badge */
        .badge-date {
            background: linear-gradient(45deg, var(--primary), var(--info));
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
            color: white;
        }

        /* Toggle Button for Mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Profile Page Styling */
        .profile-container {
            background: white;
            border-radius: var(--card-border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--info));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin-right: 1.5rem;
        }

        .profile-info h3 {
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .profile-info p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section h5 {
            color: var(--primary);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-save {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                text-align: center;
            }

            .sidebar-header h4 span, 
            .sidebar .list-group-item span,
            .user-details,
            .logout-btn span {
                display: none;
            }

            .sidebar .list-group-item i {
                margin-right: 0;
                font-size: 1.3rem;
            }

            .sidebar-header h4 i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .user-avatar {
                margin-right: 0;
            }
            
            .logout-btn i {
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: flex;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
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

        .dashboard-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .dashboard-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .dashboard-card:nth-child(4) {
            animation-delay: 0.3s;
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
        
        /* Page transition */
        .page-content {
            display: none;
        }
        
        .page-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button (Mobile Only) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4><i class="bi bi-gear-fill"></i> <span>Superadmin</span></h4>
        </div>
        
        <div class="list-group list-group-flush flex-grow-1">
            <a href="#" class="list-group-item list-group-item-action active" data-page="dashboard">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action" data-page="request">
                <i class="bi bi-cart-check"></i> <span>Request Barang</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action" data-page="sparepart">
                <i class="bi bi-tools"></i> <span>Daftar Sparepart</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action" data-page="history">
                <i class="bi bi-clock-history"></i> <span>Histori Barang</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action" data-page="profile">
                <i class="bi bi-person"></i> <span>Profil</span>
            </a>
        </div>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="user-details">
                    <p class="user-name">Superadmin</p>
                    <small class="user-role">Administrator</small>
                </div>
            </div>
            
            <button class="logout-btn" id="logoutBtn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Dashboard Page -->
        <div class="page-content active" id="dashboard-page">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Dashboard Overview</h3>
                <div>
                    <span class="badge bg-light text-dark"><i class="bi bi-calendar me-1"></i> <span id="currentDate"></span></span>
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
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card p-4">
                        <div class="card-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4 class="stats-number">156</h4>
                        <p class="stats-title">Total Sparepart</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card p-4">
                        <div class="card-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h4 class="stats-number">42</h4>
                        <p class="stats-title">Transaksi Hari Ini</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card p-4">
                        <div class="card-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h4 class="stats-number">5</h4>
                        <p class="stats-title">User Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-md-7">
                    <div class="table-container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Request Terbaru</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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

        <!-- Profile Page -->
        <div class="page-content" id="profile-page">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Edit Profil</h3>
                <div>
                    <span class="badge bg-light text-dark"><i class="bi bi-calendar me-1"></i> <span id="profileDate"></span></span>
                </div>
            </div>

            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="profile-info">
                        <h3>Superadmin</h3>
                        <p>Administrator Sistem</p>
                    </div>
                </div>

                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-section">
                                <h5>Informasi Pribadi</h5>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" value="Superadmin">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="admin@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" value="+62 812 3456 7890">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-section">
                                <h5>Pengaturan Akun</h5>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="superadmin">
                                </div>
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Password Saat Ini</label>
                                    <input type="password" class="form-control" id="currentPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirmPassword">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5>Preferensi Sistem</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifications" checked>
                                    <label class="form-check-label" for="notifications">Notifikasi Email</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="darkMode">
                                    <label class="form-check-label" for="darkMode">Mode Gelap</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="autoSave" checked>
                                    <label class="form-check-label" for="autoSave">Auto Save</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2">Batal</button>
                        <button type="button" class="btn btn-save">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast for notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="logoutToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bi bi-box-arrow-right text-primary me-2"></i>
                <strong class="me-auto">Logout Berhasil</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Anda telah berhasil logout. Sampai jumpa kembali!
            </div>
        </div>
        
        <div id="profileToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bi bi-check-circle text-success me-2"></i>
                <strong class="me-auto">Profil Diperbarui</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Perubahan profil Anda berhasil disimpan.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set current date
            const now = new Date();
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
            document.getElementById('profileDate').textContent = now.toLocaleDateString('id-ID', options);
            
            // Toggle sidebar on mobile
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && 
                    !sidebar.contains(event.target) && 
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Page navigation
            const menuItems = document.querySelectorAll('.list-group-item');
            const pages = document.querySelectorAll('.page-content');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all menu items
                    menuItems.forEach(i => i.classList.remove('active'));
                    
                    // Add active class to clicked menu item
                    this.classList.add('active');
                    
                    // Hide all pages
                    pages.forEach(page => page.classList.remove('active'));
                    
                    // Show the selected page
                    const pageId = this.getAttribute('data-page') + '-page';
                    document.getElementById(pageId).classList.add('active');
                });
            });
            
            // Logout functionality
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutToast = new bootstrap.Toast(document.getElementById('logoutToast'));
            
            logoutBtn.addEventListener('click', function() {
                // Show logout toast
                logoutToast.show();
                
                // Simulate logout process
                setTimeout(function() {
                    alert('Logout berhasil! Anda akan diarahkan ke halaman login.');
                    // In a real application, you would redirect to login page
                    // window.location.href = 'login.html';
                }, 1500);
            });
            
            // Save profile changes
            const saveBtn = document.querySelector('.btn-save');
            const profileToast = new bootstrap.Toast(document.getElementById('profileToast'));
            
            saveBtn.addEventListener('click', function() {
                // Show success toast
                profileToast.show();
            });
            
            // Animation for cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.1)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
                });
            });
            
            // Enhanced sidebar item hover effect
            const sidebarItems = document.querySelectorAll('.list-group-item');
            sidebarItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.paddingLeft = '2rem';
                });
                
                item.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.paddingLeft = '1.5rem';
                    }
                });
            });
        });
    </script>
</body>
</html>