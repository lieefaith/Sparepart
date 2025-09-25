@extends('layouts.kepalagudang')

@section('title', 'Request Sparepart - Kepalagudang')

@push('styles')
    <style>
        .table-success th {
            text-align: center;
            font-weight: 600;
        }

        .table tbody td {
            vertical-align: middle;
        }

        /* Kolom No & Aksi: kecil */
        .no-col,
        .aksi-col {
            width: 50px;
            min-width: 50px;
        }

        /* Kolom Nama, Tipe, Keterangan: lebih besar */
        .nama-col,
        .tipe-col,
        .keterangan-col {
            width: 150px;
            min-width: 150px;
        }
    </style>
@endpush

@section('content')

    <h4 class="page-title"><i class="bi bi-cart-check me-2"></i> Daftar Request Barang</h4>
    <p class="page-subtitle">Kelola permintaan barang yang sudah di-approve Superadmin</p>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="diterima">Diterima</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dateFilter" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="dateFilter">
                </div>
                <div class="col-md-4">
                    <label for="searchFilter" class="form-label">Pencarian</label>
                    <input type="text" class="form-control" id="searchFilter"
                        placeholder="Cari ID Request, Requester, atau Barang...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Terapkan Filter</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Request</th>
                            <th>Requester</th>
                            <th>Tanggal Request</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td><span class="fw-bold">{{ $req->tiket }}</span></td>
                                <td>{{ $req->user->name ?? 'User' }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($req->tanggal_permintaan)->translatedFormat('d M Y') }}
                                </td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-success btn-sm btn-terima" data-tiket="{{ $req->tiket }}"
                                        data-requester="{{ $req->user->name ?? 'User' }}"
                                        data-tanggal="{{ \Illuminate\Support\Carbon::parse($req->tanggal_permintaan)->translatedFormat('d M Y') }}">
                                        <i class="bi bi-check-circle"></i> Terima
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada permintaan yang menunggu proses pengiriman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- Modal Terima & Kirim Barang -->
    <div class="modal fade" id="modalTerima" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-box-seam"></i> Terima & Kirim Barang</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Data Request (readonly) -->
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-cart-check"></i> Data Request (readonly)</h6>
                    <div class="mb-3">
                        <p><strong>No Tiket:</strong> <span id="modal-tiket-display">-</span></p>
                        <p><strong>Requester:</strong> <span id="modal-requester">-</span></p>
                        <p><strong>Tanggal Request:</strong> <span id="modal-tanggal">-</span></p>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Item</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Diminta</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detail-request-body">
                                <!-- Akan diisi otomatis oleh JS -->
                            </tbody>
                        </table>
                    </div>



                    <hr>

                    <!-- Form Pengiriman -->
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-truck"></i> Form Pengiriman</h6>
                    <form id="formPengiriman">
                        @csrf
                        <input type="hidden" name="tiket" value="" id="tiketInput">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengiriman</label>
                                <input type="date" class="form-control" name="tanggal_pengiriman"
                                    id="tanggal_pengiriman" required>
                            </div>
                        </div>
                        <div class="mt-3 table-responsive">
                            <table class="table table-bordered" id="tabelBarang">
                                <thead class="table-success">
                                    <tr>
                                        <th class="no-col">No</th>
                                        <th class="kategori-col">Kategori</th>
                                        <th class="nama-col">Nama</th>
                                        <th class="tipe-col">Tipe</th>
                                        <th class="merk-col">Merk</th>
                                        <th class="sn-col">Nomor Serial</th>
                                        <th class="jumlah-col">Jumlah</th>
                                        <th class="keterangan-col">Keterangan</th>
                                        <th class="aksi-col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="no-col">1</td>
                                        <td class="kategori-col">
                                            <select class="form-control kategori-select" name="kategori">
                                                <option value="">Kategori</option>
                                                <option value="aset">Aset</option>
                                                <option value="non-aset">Non-Aset</option>
                                            </select>
                                        </td>
                                        <!-- Sesudah: tambah class untuk akses JS -->
                                        <td class="nama-col">
                                            <select class="form-control nama-item-select" name="nama_item">
                                                <option value="">Pilih Nama</option>
                                            </select>
                                        </td>
                                        <td class="tipe-col">
                                            <select class="form-control tipe-select" name="tipe">
                                                <option value="">Pilih Tipe</option>
                                            </select>
                                        </td>
                                        <td class="merk-col">
                                            <select class="form-control merk-select" name="merk">
                                                <option value="">Pilih Merk</option>
                                            </select>
                                        </td>
                                        <td class="sn-col"><input type="text" class="form-control"
                                                placeholder="Nomor Serial"></td>
                                        <td class="jumlah-col"><input type="number" class="form-control" value="1"
                                                min="1" required></td>
                                        <td class="keterangan-col">
                                            <input type="text" class="form-control" name="keterangan"
                                                placeholder="Keterangan">
                                        </td>
                                        <td class="aksi-col">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="hapusBaris(this)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-outline-success mt-2" onclick="tambahBaris()">
                            <i class="bi bi-plus"></i> Tambah Baris
                        </button>

                        <div class="mt-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" rows="3" placeholder="Tambahkan catatan jika ada..."></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <!-- Tombol Batal -->
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <!-- Tombol Reject -->
                    <button type="button" class="btn btn-danger" onclick="rejectRequest()">
                        <i class="bi bi-x-circle"></i> Reject
                    </button>

                    <!-- Tombol Approve -->
                    <button type="button" class="btn btn-primary" onclick="approveRequest()">
                        <i class="bi bi-check-circle"></i> Approve
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            // Toggle sidebar
            document.querySelector('.navbar-toggler')?.addEventListener('click', function() {
                document.querySelector('.sidebar')?.classList.toggle('show');
            });

            // Simple search filter
            document.getElementById('searchFilter')?.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            function getCsrfToken() {
                return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || null;
            }

            // ---------- API loaders (populate dropdowns with id as value) ----------
            async function loadItemsByKategori(selectKategori, targetSelect) {
                const kategori = selectKategori?.value;
                if (!kategori || !targetSelect) return;
                const url = `/requestbarang/api/jenis-barang?kategori=${encodeURIComponent(kategori)}`;
                console.log('[loadItemsByKategori] fetching', url);
                targetSelect.innerHTML = '<option value="">Memuat nama...</option>';
                try {
                    const res = await fetch(url);
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const items = await res.json();
                    targetSelect.innerHTML = '<option value="">Pilih Nama</option>';
                    (items || []).forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.textContent = item.nama ?? item.name ?? `Item ${item.id}`;
                        opt.dataset.nama = item.nama ?? item.name ?? '';
                        targetSelect.appendChild(opt);
                    });
                    if (targetSelect.options.length <= 1) targetSelect.innerHTML =
                        '<option value="">Tidak ada nama</option>';
                } catch (err) {
                    console.error('[loadItemsByKategori] error', err);
                    targetSelect.innerHTML = '<option value="">Gagal muat</option>';
                }
                // reset tipe
                const row = targetSelect.closest('tr');
                const tipeSelect = row?.querySelector('.tipe-select');
                if (tipeSelect) tipeSelect.innerHTML = '<option value="">Pilih Tipe</option>';
            }

            async function loadTipeByKategoriAndJenis(selectKategori, selectJenis, targetSelect) {
                const kategori = selectKategori?.value;
                if (!selectJenis || !targetSelect) {
                    if (targetSelect) targetSelect.innerHTML = '<option value="">Pilih Tipe</option>';
                    return;
                }
                const jenisId = selectJenis.options[selectJenis.selectedIndex]?.value || selectJenis.value;
                if (!kategori || !jenisId) {
                    targetSelect.innerHTML = '<option value="">Pilih Tipe</option>';
                    return;
                }
                const url =
                    `/requestbarang/api/tipe-barang?kategori=${encodeURIComponent(kategori)}&jenis_id=${encodeURIComponent(jenisId)}`;
                console.log('[loadTipeByKategoriAndJenis] fetching', url);
                targetSelect.innerHTML = '<option value="">Memuat tipe...</option>';
                try {
                    const res = await fetch(url);
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const tipes = await res.json();
                    targetSelect.innerHTML = '<option value="">Pilih Tipe</option>';
                    (tipes || []).forEach(tipe => {
                        const opt = document.createElement('option');
                        opt.value = tipe.id;
                        opt.textContent = tipe.nama ?? tipe.name ?? `Tipe ${tipe.id}`;
                        opt.dataset.nama = tipe.nama ?? tipe.name ?? '';
                        targetSelect.appendChild(opt);
                    });
                    if (targetSelect.options.length <= 1) targetSelect.innerHTML =
                        '<option value="">Tidak ada tipe</option>';
                } catch (err) {
                    console.error('[loadTipeByKategoriAndJenis] error', err);
                    targetSelect.innerHTML = '<option value="">Gagal muat</option>';
                }
                // reset merk in the same row
                const row = targetSelect.closest('tr');
                const merkSelect = row?.querySelector('.merk-select');
                if (merkSelect) merkSelect.innerHTML = '<option value="">Pilih Merk</option>';
            }

            async function loadVendors(selectJenisOrTarget, selectTipe, targetSelect) {
                if (!targetSelect) {
                    if (selectJenisOrTarget && selectJenisOrTarget.tagName === 'SELECT') {
                        selectJenisOrTarget.innerHTML = '<option value="">Pilih Merk</option>';
                    }
                    return;
                }

                const selectJenis = selectJenisOrTarget;
                const jenisId = selectJenis?.options[selectJenis.selectedIndex]?.value || selectJenis?.value || '';
                const tipeId = selectTipe?.options[selectTipe.selectedIndex]?.value || selectTipe?.value || '';

                console.log('[loadVendors] jenisId:', jenisId, 'tipeId:', tipeId);
                if (!jenisId || !tipeId) {
                    targetSelect.innerHTML = '<option value="">Pilih Merk</option>';
                    return;
                }

                const url =
                    `/requestbarang/api/vendor?jenis_id=${encodeURIComponent(jenisId)}&tipe_id=${encodeURIComponent(tipeId)}`;
                console.log('[loadVendors] fetching', url);
                targetSelect.innerHTML = '<option value="">Memuat merk...</option>';
                try {
                    const res = await fetch(url);
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const vendors = await res.json();
                    targetSelect.innerHTML = '<option value="">Pilih Merk</option>';
                    (vendors || []).forEach(vendor => {
                        const opt = document.createElement('option');
                        opt.value = vendor.id;
                        opt.textContent = vendor.nama ?? vendor.name ?? `Vendor ${vendor.id}`;
                        opt.dataset.nama = vendor.nama ?? vendor.name ?? '';
                        targetSelect.appendChild(opt);
                    });
                    if (targetSelect.options.length <= 1) targetSelect.innerHTML =
                        '<option value="">Tidak ada merk</option>';
                } catch (err) {
                    console.error('[loadVendors] error', err);
                    targetSelect.innerHTML = '<option value="">Gagal muat</option>';
                }
            }

            // ---------- SN lookup (tolerant) ----------
            async function fetchItemBySN(sn) {
                if (!sn) return null;
                try {
                    console.log('[fetchItemBySN] fetching SN:', sn);
                    const res = await fetch(`/kepalagudang/sn-info?sn=${encodeURIComponent(sn)}`);
                    if (!res.ok) {
                        console.warn('[fetchItemBySN] non-ok', res.status, await res.text());
                        return null;
                    }
                    const data = await res.json();
                    console.log('[fetchItemBySN] response', data);
                    if (!data) return null;
                    // Support shapes: { success:true, item: {...} } or direct item
                    const item = data.item ?? data;
                    if (!item) return null;
                    return item;
                } catch (err) {
                    console.error('[fetchItemBySN] error', err);
                    return null;
                }
            }

            // ---------- Row builders / populators ----------
            function buildRow(idx, item = {}) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
<td class="no-col">${idx + 1}</td>
<td class="kategori-col">
  <select class="form-control kategori-select" name="items[${idx}][kategori]">
    <option value="">Kategori</option>
    <option value="aset">Aset</option>
    <option value="non-aset">Non-Aset</option>
  </select>
</td>
<td class="nama-col">
  <!-- placeholder saja, jangan isi otomatis -->
  <select class="form-control nama-item-select" name="items[${idx}][nama_item_id]">
    <option value="">Pilih Nama</option>
  </select>
</td>
<td class="tipe-col">
  <select class="form-control tipe-select" name="items[${idx}][tipe_id]">
    <option value="">Pilih Tipe</option>
  </select>
</td>
<td class="merk-col">
  <select class="form-control merk-select" name="items[${idx}][merk_id]">
    <option value="">Pilih Merk</option>
  </select>
</td>
<td class="sn-col"><input type="text" class="form-control sn-input" name="items[${idx}][sn]" placeholder="Nomor Serial" disabled></td>
<td class="jumlah-col"><input type="number" class="form-control" name="items[${idx}][jumlah]" value="${item.jumlah || 1}" min="1" required></td>
<td class="keterangan-col">
  <input type="text" class="form-control" name="items[${idx}][keterangan]" value="" placeholder="Keterangan">
</td>
<td class="aksi-col">
  <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">
    <i class="bi bi-trash"></i>
  </button>
</td>
`;
                return tr;
            }

            async function populateRowWithItem(tr, item = {}, snInfo = null) {
                try {
                    const kategoriSelect = tr.querySelector('.kategori-select');
                    const namaSelect = tr.querySelector('.nama-item-select');
                    const tipeSelect = tr.querySelector('.tipe-select');
                    const merkSelect = tr.querySelector('.merk-select');
                    const snInput = tr.querySelector('.sn-input');
                    const jumlahInput = tr.querySelector('input[name*="[jumlah]"]');
                    const keteranganInput = tr.querySelector('input[name*="[keterangan]"]');

                    // set kategori first
                    if (item.kategori) {
                        kategoriSelect.value = item.kategori;
                        kategoriSelect.dispatchEvent(new Event('change'));
                    } else {
                        // kosongkan nama/tipe/merk jika kategori belum ada
                        if (namaSelect) namaSelect.innerHTML = '<option value="">Pilih Nama</option>';
                        if (tipeSelect) tipeSelect.innerHTML = '<option value="">Pilih Tipe</option>';
                        if (merkSelect) merkSelect.innerHTML = '<option value="">Pilih Merk</option>';
                    }

                    // hanya load nama jika kategori tersedia
                    if (kategoriSelect.value) {
                        await loadItemsByKategori(kategoriSelect, namaSelect);

                        // jika item menyertakan nama_id, pilih itu
                        const idVal = item.nama_item_id ?? item.nama_item;
                        if (idVal) {
                            let opt = Array.from(namaSelect.options).find(o => String(o.value) === String(idVal));
                            if (!opt) {
                                opt = document.createElement('option');
                                opt.value = idVal;
                                opt.textContent = item.nama_item_label ?? item.nama_item ?? idVal;
                                namaSelect.appendChild(opt);
                            }
                            namaSelect.value = String(idVal);
                            namaSelect.dispatchEvent(new Event('change'));
                        }
                    }

                    // hanya load tipe jika nama (jenis) tersedia
                    if (namaSelect.value) {
                        await loadTipeByKategoriAndJenis(kategoriSelect, namaSelect, tipeSelect);

                        const tipeId = item.tipe_id ?? item.tipe;
                        if (tipeId) {
                            let tipeOpt = Array.from(tipeSelect.options).find(o => String(o.value) === String(
                                tipeId));
                            if (!tipeOpt) {
                                tipeOpt = document.createElement('option');
                                tipeOpt.value = tipeId;
                                tipeOpt.textContent = item.tipe_label ?? item.tipe ?? tipeId;
                                tipeSelect.appendChild(tipeOpt);
                            }
                            tipeSelect.value = String(tipeId);
                            tipeSelect.dispatchEvent(new Event('change'));
                        }
                    } else {
                        if (tipeSelect) tipeSelect.innerHTML = '<option value="">Pilih Tipe</option>';
                    }

                    // only load vendors if both nama and tipe are selected
                    if (namaSelect.value && tipeSelect.value) {
                        await loadVendors(namaSelect, tipeSelect, merkSelect);

                        const merkId = item.merk_id ?? item.merk;
                        if (merkId) {
                            let findOpt = Array.from(merkSelect.options).find(o => String(o.value) === String(
                                merkId));
                            if (!findOpt) {
                                const newOpt = document.createElement('option');
                                newOpt.value = merkId;
                                newOpt.textContent = item.merk_label ?? item.merk ?? merkId;
                                merkSelect.appendChild(newOpt);
                            }
                            merkSelect.value = String(merkId);
                        }
                    } else {
                        if (merkSelect) merkSelect.innerHTML = '<option value="">Pilih Merk</option>';
                    }

                    // jumlah
                    if (jumlahInput) jumlahInput.value = item.jumlah || 1;

                    // SN handling (unchanged) - but if SN provides nama/tipe/vendor, only set them if category/name present
                    const snFromRequest = item.sn || item.serial_number || null;
                    if (!snInfo && snFromRequest) snInfo = await fetchItemBySN(snFromRequest);

                    if (snInput) {
                        if (kategoriSelect && kategoriSelect.value === 'aset') {
                            snInput.disabled = false;
                            snInput.required = true;
                        } else {
                            snInput.disabled = true;
                            snInput.required = false;
                            snInput.value = '';
                        }
                        if (snFromRequest) snInput.value = snFromRequest;
                    }

                    // keterangan only from SN
                    if (keteranganInput) {
                        keteranganInput.value = (snInfo && (snInfo.keterangan ?? snInfo.note ?? null)) ? (snInfo
                            .keterangan ?? snInfo.note) : '';
                    }

                    // If snInfo exists and category/name present, prefer snInfo values
                    if (snInfo) {
                        // only set nama if kategori/name is available (or force if you want)
                        if (kategoriSelect.value) {
                            if (snInfo.nama_id || snInfo.id) {
                                const nid = snInfo.nama_id ?? snInfo.id;
                                let opt = Array.from(namaSelect.options).find(o => String(o.value) === String(nid));
                                if (!opt) {
                                    opt = document.createElement('option');
                                    opt.value = nid;
                                    opt.textContent = snInfo.nama ?? snInfo.name ?? `Item ${nid}`;
                                    namaSelect.appendChild(opt);
                                }
                                namaSelect.value = String(nid);
                                namaSelect.dispatchEvent(new Event('change'));
                                // reload tipe then vendors as above
                                await loadTipeByKategoriAndJenis(kategoriSelect, namaSelect, tipeSelect);
                                await loadVendors(namaSelect, tipeSelect, merkSelect);
                            }
                            if (snInfo.tipe_id) {
                                const tid = snInfo.tipe_id;
                                let tipeOpt = Array.from(tipeSelect.options).find(o => String(o.value) === String(
                                    tid));
                                if (!tipeOpt) {
                                    tipeOpt = document.createElement('option');
                                    tipeOpt.value = tid;
                                    tipeOpt.textContent = snInfo.tipe_nama ?? snInfo.tipe ?? `Tipe ${tid}`;
                                    tipeSelect.appendChild(tipeOpt);
                                }
                                tipeSelect.value = String(tid);
                                tipeSelect.dispatchEvent(new Event('change'));
                            }
                            if (snInfo.vendor_id) {
                                const vid = snInfo.vendor_id;
                                let vendOpt = Array.from(merkSelect.options).find(o => String(o.value) === String(
                                    vid));
                                if (!vendOpt) {
                                    vendOpt = document.createElement('option');
                                    vendOpt.value = vid;
                                    vendOpt.textContent = snInfo.vendor_nama ?? snInfo.vendor ?? `Vendor ${vid}`;
                                    merkSelect.appendChild(vendOpt);
                                }
                                merkSelect.value = String(vid);
                            }
                        }
                    }

                } catch (err) {
                    console.error('populateRowWithItem error:', err);
                }
            }

            // ---------- Buttons and modal handling ----------
            window.hapusBaris = function(button) {
                const tr = button.closest('tr');
                const tbody = tr.parentElement;
                if (tbody.children.length > 1) {
                    tr.remove();
                    // reindex nomor & name attributes
                    Array.from(tbody.children).forEach((row, i) => {
                        row.cells[0].textContent = i + 1;
                        row.querySelectorAll('[name]').forEach(el => {
                            const name = el.getAttribute('name');
                            const newName = name.replace(/items$$\d+$$/, `items[${i}]`);
                            el.setAttribute('name', newName);
                        });
                    });
                } else {
                    alert('Minimal satu baris harus ada.');
                }
            };

            window.tambahBaris = function() {
                const tbody = document.querySelector('#tabelBarang tbody');
                const nomorBaru = tbody.children.length + 1;
                const tr = buildRow(nomorBaru - 1, {});
                tbody.appendChild(tr);
            };

            // allRequests from Blade injection
            const allRequests = @json($requests);

            // open modal handler
            document.querySelectorAll('.btn-terima').forEach(button => {
                button.addEventListener('click', function() {
                    const tiket = this.dataset.tiket;
                    const requester = this.dataset.requester;
                    const tanggal = this.dataset.tanggal;

                    document.getElementById('tiketInput').value = tiket;
                    document.getElementById('modal-tiket-display').textContent = tiket;
                    document.getElementById('modal-requester').textContent = requester;
                    document.getElementById('modal-tanggal').textContent = tanggal;

                    const req = allRequests.find(r => r.tiket === tiket) || {
                        details: []
                    };
                    const detailBody = document.getElementById('detail-request-body');
                    detailBody.innerHTML = '';

                    if (req.details && req.details.length) {
                        req.details.forEach((item, index) => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
<td>${index + 1}</td>
<td>${item.nama_item ?? item.nama ?? '-'}</td>
<td>${item.deskripsi ?? '-'}</td>
<td>${item.jumlah ?? '-'}</td>
<td>${item.keterangan ?? '-'}</td>
`;
                            detailBody.appendChild(tr);
                        });
                    } else {
                        const tr = document.createElement('tr');
                        tr.innerHTML = '<td colspan="6" class="text-center">Tidak ada item.</td>';
                        detailBody.appendChild(tr);
                    }

                    // build form rows
                    const tbody = document.querySelector('#tabelBarang tbody');
                    tbody.innerHTML = '';
                    if (!req.details || req.details.length === 0) {
                        tbody.appendChild(buildRow(0, {}));
                    } else {
                        req.details.forEach((item, idx) => {
                            tbody.appendChild(buildRow(idx, item));
                        });
                    }

                    // show modal then populate rows (fetch SNs in parallel)
                    const modalEl = document.getElementById('modalTerima');
                    const modal = new bootstrap.Modal(modalEl);

                    async function onShown() {
                        const rows = Array.from(document.querySelectorAll('#tabelBarang tbody tr'));
                        const snList = (req.details || []).map(d => d.sn || d.serial_number ||
                        null);
                        const fetchPromises = snList.map(sn => sn ? fetchItemBySN(sn) : Promise
                            .resolve(null));
                        const snInfos = await Promise.all(fetchPromises);
                        for (let i = 0; i < rows.length; i++) {
                            const tr = rows[i];
                            const item = (req.details && req.details[i]) ? req.details[i] : {};
                            const snInfoForThis = snInfos[i] || null;
                            await populateRowWithItem(tr, item, snInfoForThis);
                        }
                        modalEl.removeEventListener('shown.bs.modal', onShown);
                    }

                    modalEl.addEventListener('shown.bs.modal', onShown);
                    modal.show();
                });
            });

            // ---------- Approve / Reject ----------
            // Approve Request
// Approve Request (kirim label, bukan id)
async function approveRequest() {
    const tiket = document.getElementById('tiketInput').value;
    if (!tiket) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        alert('CSRF token tidak ditemukan.');
        return;
    }

    const tanggalInput = document.getElementById('tanggal_pengiriman');
    if (!tanggalInput || !tanggalInput.value) {
        alert('Tanggal Pengiriman wajib diisi.');
        return;
    }
    const tanggalPengiriman = tanggalInput.value;
    const catatan = document.querySelector('[name="catatan"]')?.value || '';

    const rows = document.querySelectorAll('#tabelBarang tbody tr');
    const items = [];
    let valid = true;

    for (const row of rows) {
        const cells = row.cells;
        const kategori = cells[1].querySelector('select')?.value;

        // ambil label (text) untuk nama, tipe, merk
        const namaSelect = cells[2].querySelector('select');
        const namaLabel = namaSelect?.options[namaSelect.selectedIndex]?.textContent?.trim() || '';

        const tipeSelect = cells[3].querySelector('select');
        const tipeLabel = tipeSelect?.options[tipeSelect.selectedIndex]?.textContent?.trim() || '';

        const merkEl = cells[4].querySelector('select, input');
        const merkLabel = merkEl ? (merkEl.options ? merkEl.options[merkEl.selectedIndex]?.textContent?.trim() : (merkEl.value || '').trim()) : '';

        const sn = cells[5].querySelector('input')?.value.trim();
        const jumlah = cells[6].querySelector('input')?.value.trim();
        const keterangan = cells[7].querySelector('input')?.value.trim();

        // validasi dasar
        if (!kategori || !namaLabel || !jumlah) {
            valid = false;
            continue;
        }

        if (kategori === 'aset' && !sn) {
            alert(`Serial Number wajib diisi untuk barang Aset di baris ${row.rowIndex}.`);
            return;
        }

        items.push({
            kategori,
            nama_item: namaLabel,    // kirim label, bukan id
            tipe: tipeLabel,         // kirim label
            merk: merkLabel,         // kirim label
            sn: sn || null,
            jumlah: parseInt(jumlah),
            keterangan: keterangan || null
        });
    }

    if (!valid || items.length === 0) {
        alert('Isi minimal satu barang dengan lengkap.');
        return;
    }

    console.log("📦 Mengirim data ke server:", {
        tiket,
        tanggal_pengiriman: tanggalPengiriman,
        catatan,
        items
    });

    try {
        const response = await fetch(`/kepalagudang/request/${tiket}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                tiket,
                tanggal_pengiriman: tanggalPengiriman,
                catatan,
                items
            })
        });
        if (!response.ok) throw new Error('Server error ' + response.status);
        const data = await response.json();
        const msg = data.message || 'Terjadi kesalahan. Cek log server.';
        if (data.success) {
            alert(msg);
            location.reload();
        } else {
            alert('Gagal: ' + msg);
        }
    } catch (err) {
        console.error('Fetch error:', err);
        alert('Terjadi kesalahan teknis. Cek koneksi atau refresh halaman.');
    }
}
window.approveRequest = approveRequest;

            window.approveRequest = approveRequest;

            function rejectRequest() {
                const tiket = document.getElementById('tiketInput').value;
                if (!tiket) return;

                const catatan = prompt('Masukkan alasan penolakan (opsional):', '');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
                    return;
                }

                fetch(`/kepalagudang/request/${tiket}/reject`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            tiket,
                            catatan
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            const modal = bootstrap.Modal.getInstance(document.getElementById('modalTerima'));
                            modal.hide();
                            location.reload();
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        alert('Terjadi kesalahan teknis.');
                    });
            }
            window.rejectRequest = rejectRequest;

            // ---------- Event delegation ----------
            document.addEventListener('change', function(e) {
                const el = e.target;
                if (el.matches('.kategori-select')) {
                    const tr = el.closest('tr');
                    const namaSelect = tr.querySelector('.nama-item-select');
                    const snInput = tr.querySelector('.sn-input'); // gunakan kelas sn-input

                    console.log('kategori changed', el.value);

                    // enable/disable SN sesuai kategori
                    if (snInput) {
                        if (el.value === 'aset') {
                            snInput.disabled = false;
                            snInput.required = true;
                            snInput.placeholder = 'Nomor Serial (wajib untuk aset)';
                        } else if (el.value === 'non-aset') {
                            snInput.disabled = true;
                            snInput.required = false;
                            snInput.value = '';
                            snInput.placeholder = 'Tidak diperlukan untuk Non-Aset';
                        } else {
                            snInput.disabled = true;
                            snInput.required = false;
                            snInput.value = '';
                            snInput.placeholder = 'Pilih kategori terlebih dahulu';
                        }
                    }

                    // load nama (tetap dipanggil)
                    if (typeof loadItemsByKategori === 'function') loadItemsByKategori(el, namaSelect);
                }
                if (el.matches('.nama-item-select')) {
                    const tr = el.closest('tr');
                    const kategori = tr.querySelector('.kategori-select');
                    const tipe = tr.querySelector('.tipe-select');
                    console.log('nama changed', el.value);
                    if (kategori && tipe) loadTipeByKategoriAndJenis(kategori, el, tipe);
                }
                if (el.matches('.tipe-select')) {
                    const tr = el.closest('tr');
                    const nama = tr.querySelector('.nama-item-select');
                    const merk = tr.querySelector('.merk-select');
                    console.log('tipe changed', el.value);
                    if (nama && merk) loadVendors(nama, el, merk);
                }
            });

            // SN input handlers (focusout & Enter)
            document.addEventListener('focusout', function(e) {
                const el = e.target;
                if (el.matches('#tabelBarang .sn-col input')) {
                    if (el.disabled) return;
                    handleSnInputEvent(el);
                }
            }, true);
            document.addEventListener('keydown', function(e) {
                const el = e.target;
                if (e.key === 'Enter' && el.matches('#tabelBarang .sn-col input')) {
                    e.preventDefault();
                    if (el.disabled) return;
                    handleSnInputEvent(el);
                }
            });

            async function handleSnInputEvent(inputEl) {
                if (!inputEl || inputEl.disabled) return;
                const sn = inputEl.value.trim();
                const tr = inputEl.closest('tr');
                if (!tr) return;
                const kategoriSelect = tr.querySelector('.kategori-select');
                if (kategoriSelect && kategoriSelect.value !== 'aset') return;

                const keteranganInput = tr.querySelector('.keterangan-col input, .keterangan-col textarea');
                if (keteranganInput) keteranganInput.value = '';

                if (!sn) return;
                const item = await fetchItemBySN(sn);
                if (!item) {
                    alert(`SN "${sn}" tidak ditemukan di database.`);
                    if (keteranganInput) keteranganInput.value = '';
                    return;
                }

                const namaSelect = tr.querySelector('.nama-item-select');
                const tipeSelect = tr.querySelector('.tipe-select');
                const merkSelect = tr.querySelector('.merk-select');

                // set nama by id
                if (item.nama_id || item.id) {
                    const nid = item.nama_id ?? item.id;
                    let opt = Array.from(namaSelect.options).find(o => String(o.value) === String(nid));
                    if (!opt) {
                        opt = document.createElement('option');
                        opt.value = nid;
                        opt.textContent = item.nama ?? item.name ?? `Item ${nid}`;
                        namaSelect.appendChild(opt);
                    }
                    namaSelect.value = String(nid);
                    namaSelect.dispatchEvent(new Event('change'));
                }

                // ensure tipe options loaded and set
                await loadTipeByKategoriAndJenis(kategoriSelect, namaSelect, tipeSelect);
                if (item.tipe_id) {
                    const tid = item.tipe_id;
                    let tipeOpt = Array.from(tipeSelect.options).find(o => String(o.value) === String(tid));
                    if (!tipeOpt) {
                        tipeOpt = document.createElement('option');
                        tipeOpt.value = tid;
                        tipeOpt.textContent = item.tipe_nama ?? item.tipe ?? `Tipe ${tid}`;
                        tipeSelect.appendChild(tipeOpt);
                    }
                    tipeSelect.value = String(tid);
                    tipeSelect.dispatchEvent(new Event('change'));
                }

                // ensure vendors loaded and set merk
                await loadVendors(namaSelect, tipeSelect, merkSelect);
                if (item.vendor_id) {
                    const vid = item.vendor_id;
                    let vendOpt = Array.from(merkSelect.options).find(o => String(o.value) === String(vid));
                    if (!vendOpt) {
                        vendOpt = document.createElement('option');
                        vendOpt.value = vid;
                        vendOpt.textContent = item.vendor_nama ?? item.vendor ?? `Vendor ${vid}`;
                        merkSelect.appendChild(vendOpt);
                    }
                    merkSelect.value = String(vid);
                }

                // keterangan
                if (keteranganInput) keteranganInput.value = item.keterangan ?? item.note ?? '';
            }

            // Initial state for static rows (on page load)
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('#tabelBarang tbody tr').forEach((tr, idx) => {
                    const kategori = tr.querySelector('.kategori-select')?.value;
                    const snInput = tr.querySelector('.sn-col input');
                    if (!snInput) return;
                    if (!kategori) {
                        snInput.disabled = true;
                        snInput.placeholder = 'Pilih kategori terlebih dahulu';
                        snInput.removeAttribute('required');
                    } else if (kategori === 'aset') {
                        snInput.disabled = false;
                        snInput.required = true;
                        snInput.placeholder = 'Nomor Serial (wajib untuk aset)';
                    } else {
                        snInput.disabled = true;
                        snInput.value = '';
                        snInput.placeholder = 'Tidak diperlukan untuk Non-Aset';
                        snInput.removeAttribute('required');
                    }

                    // reindex names for compatibility
                    tr.querySelectorAll('[name]').forEach(el => {
                        const name = el.getAttribute('name');
                        if (!/items$$\d+$$/.test(name)) {
                            const field = name.includes('[') ? name.split('[')[0] : name;
                            if (['kategori', 'nama_item', 'tipe', 'merk', 'sn', 'jumlah',
                                    'keterangan', 'nama_item_id', 'tipe_id', 'merk_id'
                                ].includes(field)) {
                                const newName = `items[${idx}][${field}]`;
                                el.setAttribute('name', newName);
                            }
                        }
                    });
                });
            });

        })();
    </script>
@endpush
