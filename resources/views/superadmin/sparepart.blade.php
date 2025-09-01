<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sparepart - Superadmin</title>
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
                        class="list-group-item list-group-item-action py-3 active">
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
                            <h4 class="fw-bold mb-0"><i class="bi bi-tools me-2"></i>Daftar Sparepart</h4>
                            <p class="text-muted mb-0">Kelola data sparepart yang tersedia di sistem</p>
                        </div>
                        <div>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahSparepartModal">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Sparepart
                            </button>
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-card">
                    <h5 class="mb-4"><i class="bi bi-funnel me-2"></i>Filter Sparepart</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="statusFilter" class="form-label">Status Sparepart</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="habis">Habis</option>
                                <option value="dipesan">Dipesan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="jenisFilter" class="form-label">Jenis Sparepart</label>
                            <select class="form-select" id="jenisFilter">
                                <option value="">Semua Jenis</option>
                                <option value="oli">Oli Mesin</option>
                                <option value="kampas">Kampas Rem</option>
                                <option value="filter">Filter</option>
                                <option value="busi">Busi</option>
                                <option value="aki">Aki</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="searchFilter" class="form-label">Cari Sparepart</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari ID atau nama sparepart..."
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
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-box-seam text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Sparepart</h6>
                                    <h4 class="mb-0 fw-bold text-primary">142</h4>
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
                                    <h4 class="mb-0 fw-bold text-success">98</h4>
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
                                    <h4 class="mb-0 fw-bold text-warning">24</h4>
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
                                    <h4 class="mb-0 fw-bold text-danger">20</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
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
                                        <td>{{ $barang->status }}</td>
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
                                            <button class="btn btn-info btn-sm btn-detail" data-id="SP002"
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



                <!-- Pagination -->
                <div class="pagination-container d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan 1 hingga 5 dari 142 entri
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"
                                    aria-disabled="true">Sebelumnya</a>
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

    <!-- Modal Tambah Sparepart -->
    <div class="modal fade" id="tambahSparepartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Sparepart Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- Jenis -->
                        <div class="mb-3">
                            <label for="jenisSparepart" class="form-label">Jenis Sparepart</label>
                            <select class="form-select" id="jenisSparepart">
                                <option selected>Pilih jenis sparepart</option>
                                <option>Kampas Rem</option>
                                <option>Oli Mesin</option>
                                <option>Filter</option>
                                <option>Busi</option>
                                <option>Aki</option>
                            </select>
                        </div>
                        <!-- Type -->
                        <div class="mb-3">
                            <label for="typeSparepart" class="form-label">Type</label>
                            <input type="text" class="form-control" id="typeSparepart"
                                placeholder="Masukkan type sparepart">
                        </div>
                        <!-- Serial Number -->
                        <div class="mb-3">
                            <label for="serialNumber" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serialNumber"
                                placeholder="Masukkan serial number">
                        </div>
                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Masukkan jumlah">
                        </div>
                        <!-- Vendor -->
                        <div class="mb-3">
                            <label for="vendor" class="form-label">Vendor</label>
                            <select class="form-select" id="vendor">
                                <option selected>Pilih vendor</option>
                                <option>PT Auto Parts</option>
                                <option>PT Lubricants</option>
                                <option>PT Filter Indonesia</option>
                                <option>PT Spark Plug</option>
                                <option>PT Battery Life</option>
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option selected>Pilih status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="dipesan">Dipesan</option>
                                <option value="kosong">Kosong</option>
                            </select>
                        </div>
                        <!-- Harga -->
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" placeholder="Masukkan harga">
                        </div>
                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" rows="3" placeholder="Tambahkan keterangan sparepart"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Detail Transaksi -->
    <div class="modal fade" id="transaksiDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Detail Transaksi</h5>
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
                                <tbody>
                                    @forelse ($listBarang as $item)
                                        <tr>
                                            <td><span class="fw-bold">{{ $item->tiket_sparepart }}</span></td>
                                            <td>{{ $item->details->first()->nama_barang ?? '-' }}</td>
                                            <td>
                                                <span
                                                    class="badge 
                    {{ $item->status == 'tersedia' ? 'bg-success' : ($item->status == 'dipesan' ? 'bg-warning' : 'bg-danger') }} 
                    status-badge">
                                                    {{ ucfirst($item->status ?? 'kosong') }}
                                                </span>
                                            </td>
                                            <td>{{ $item->details->sum('quantity') }}</td>
                                            <td>{{ $item->pic ?? '-' }}</td>
                                            <td>{{ $item->tanggal->format('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-action" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-action" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <button class="btn btn-info btn-sm btn-detail"
                                                    data-id="{{ $item->tiket_sparepart }}" title="Detail">
                                                    <i class="bi bi-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada sparepart</p>
                                            </td>
                                        </tr>
                                    @endforelse
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
    {{-- <script>
        const transaksiData = {
            "SP001": {
                tanggal: "27 Agustus 2025",
                items: [
                    { serial: "SN-001", type: "1G-850nm-300m", jenis: "SFP", harga: 750000, vendor: "PT Optik Nusantara", spk: "SPK-001", keterangan: "Barang ready stock" },
                    { serial: "SN-002", type: "1G-1310nm-10km", jenis: "SFP", harga: 1200000, vendor: "PT Fiber Link", spk: "SPK-002", keterangan: "Dipesan untuk proyek Batam" },
                    { serial: "SN-003", type: "1G-1550nm-40km", jenis: "SFP", harga: 1800000, vendor: "PT Cahaya Fiber", spk: "SPK-003", keterangan: "Stok untuk Jakarta Barat" },
                    { serial: "SN-004", type: "1G-850nm-2km", jenis: "SFP", harga: 950000, vendor: "PT Metro Optik", spk: "SPK-004", keterangan: "Cadangan untuk gudang pusat" },
                    { serial: "SN-005", type: "1G-1310nm-20km", jenis: "SFP", harga: 1350000, vendor: "PT Fiber Link", spk: "SPK-005", keterangan: "Untuk penggantian unit lama" }
                ]
            },
            "SP002": {
                tanggal: "28 Agustus 2025",
                items: [
                    { serial: "SN-006", type: "1G-850nm-10km", jenis: "SFP", harga: 900000, vendor: "PT Jaringan Sentosa", spk: "SPK-006", keterangan: "Untuk gudang Jakarta" },
                    { serial: "SN-007", type: "1G-1550nm-80km", jenis: "SFP", harga: 2200000, vendor: "PT Cahaya Fiber", spk: "SPK-007", keterangan: "Pengadaan proyek Surabaya" },
                    { serial: "SN-008", type: "1G-850nm-500m", jenis: "SFP", harga: 800000, vendor: "PT Optik Nusantara", spk: "SPK-008", keterangan: "Testing dan lab" }
                ]
            }
        };


        document.addEventListener("DOMContentLoaded", function () {
            transaksiDetailModal = new bootstrap.Modal(document.getElementById('transaksiDetailModal'));

            document.querySelectorAll(".btn-detail").forEach(btn => {
                btn.addEventListener("click", function () {
                    const id = this.dataset.id;
                    const data = transaksiData[id];
                    if (data) {
                        showTransaksiDetail(data);
                    }
                });
            });
        });


        let transaksiDetailModal;

        document.addEventListener('DOMContentLoaded', function () {
            transaksiDetailModal = new bootstrap.Modal(document.getElementById('transaksiDetailModal'));
        });

        function formatRupiah(val) {
            const num = Number(String(val).replace(/\D/g, '')) || 0;
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
        }

        // contoh fungsi untuk tampilkan detail transaksi
        function showTransaksiDetail(data) {
            // data = {id, tanggal, items: [{serial, type, jenis, harga, vendor, spk, keterangan}]}

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
            <td>${item.type || '-'}</td>
            <td>${item.jenis || '-'}</td>
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


    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            transaksiDetailModal = new bootstrap.Modal(document.getElementById('transaksiDetailModal'));

            document.querySelectorAll(".btn-detail").forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.dataset.id;
                    console.log(items)

                    // fetch ke backend Laravel
                    fetch(`/sparepart/${id}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log("Data dari server:", data); // cek dulu di console
                            showTransaksiDetail(data);
                        })
                        .catch(err => console.error("Error:", err));
                });
            });
        });

        let transaksiDetailModal;

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
                    <td>${i + 1}</td>a
                    <td>${item.serial || '-'}<td>
                    <td>${item.type || '-'}</td>
                    <td>${item.jenis || '-'}</td>
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
    </script>


</body>

</html>
