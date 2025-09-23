@extends('layouts.app')

@section('title', 'Manajemen Data User')
@section('page_title', 'Manajemen Data User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/menu/data">Manajemen Data</a></li>
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar User</h3>
                            <div class="card-tools">
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Tambah User
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Cari user...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="roleFilter">
                                        <option value="">Semua Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-secondary" id="exportBtn">
                                        <i class="fas fa-download"></i> Export
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="userTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>RO</th>
                                            <th>Atasan</th>
                                            <th>Joined</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'manager' ? 'info' : 'success') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->ro ?? '-' }}</td>
                                            <td>{{ $user->supervisor ?? '-' }}</td>
                                            <td>{{ $user->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <div>
                                    Menampilkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} dari {{ $users->total() }} entri
                                </div>
                                <div>
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .card-header {
        background-color: #4f52ba;
        color: white;
    }
    .btn-primary {
        background-color: #4f52ba;
        border-color: #4f52ba;
    }
    .btn-primary:hover {
        background-color: #3f42a7;
        border-color: #3f42a7;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .badge-danger {
        background-color: #dc3545;
    }
    .badge-info {
        background-color: #17a2b8;
    }
    .badge-success {
        background-color: #28a745;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('userTable');
        const rows = table.getElementsByTagName('tr');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.indexOf(searchText) > -1) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });
        
        // Role filter functionality
        const roleFilter = document.getElementById('roleFilter');
        
        roleFilter.addEventListener('change', function() {
            const filterValue = this.value.toLowerCase();
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const roleCell = row.getElementsByTagName('td')[3];
                
                if (roleCell) {
                    const roleText = roleCell.textContent.toLowerCase();
                    if (filterValue === '' || roleText === filterValue) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        });
        
        // Export button functionality
        const exportBtn = document.getElementById('exportBtn');
        
        exportBtn.addEventListener('click', function() {
            alert('Fitur export akan diimplementasikan di sini.');
            // Di sini biasanya akan diimplementasikan logika untuk export data
        });
    });
</script>
@endsection