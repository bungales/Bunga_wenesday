@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data Pelanggan</h1>
            <p class="mb-0">List data seluruh pelanggan</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus me-1"></i> Tambah Pelanggan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select name="gender" class="form-select" onchange="window.location.href=this.value">
                            <option value="{{ request()->fullUrlWithQuery(['gender' => '']) }}">All Gender</option>
                            <option value="{{ request()->fullUrlWithQuery(['gender' => 'Male']) }}"
                                {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="{{ request()->fullUrlWithQuery(['gender' => 'Female']) }}"
                                {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="{{ request()->fullUrlWithQuery(['gender' => 'Other']) }}"
                                {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('pelanggan.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                       value="{{ request('search') }}" placeholder="Search name or email...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                   class="btn btn-outline-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Pelanggan -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="20%">Nama</th>
                                <th width="15%">Tanggal Lahir</th>
                                <th width="10%">Gender</th>
                                <th width="20%">Email</th>
                                <th width="15%">Telepon</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataPelanggan as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->first_name }} {{ $item->last_name }}</strong>
                                </td>
                                <td>{{ $item->birthday ? \Carbon\Carbon::parse($item->birthday)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <span class="badge
                                        @if($item->gender == 'Male') bg-primary
                                        @elseif($item->gender == 'Female') bg-success
                                        @else bg-secondary @endif">
                                        {{ $item->gender }}
                                    </span>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?: '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('pelanggan.show', $item->pelanggan_id) }}"
                                           class="btn btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}"
                                           class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Hapus pelanggan ini?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada data pelanggan ditemukan.</p>
                                    <a href="{{ route('pelanggan.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus me-1"></i> Tambah Pelanggan Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($dataPelanggan->hasPages())
                <div class="mt-4">
                    {{ $dataPelanggan->links('pagination::bootstrap-5') }}
                </div>
                @endif

                <!-- Info Jumlah Data -->
                <div class="mt-3 text-muted">
                    Menampilkan {{ $dataPelanggan->firstItem() ?? 0 }} - {{ $dataPelanggan->lastItem() ?? 0 }}
                    dari total {{ $dataPelanggan->total() }} pelanggan
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}
.btn-group .btn {
    margin: 0 2px;
}
</style>
@endsection
