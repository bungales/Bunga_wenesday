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
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Pelanggan</h1>
            <p class="mb-0">Informasi detail dan file pendukung pelanggan.</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <!-- Informasi Pelanggan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Informasi Personal</h5>
                            <div class="btn-group">
                                <!-- Tombol Edit -->
                                <a href="{{ route('pelanggan.edit', $dataPelanggan->pelanggan_id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <!-- Tombol Delete -->
                                <form action="{{ route('pelanggan.destroy', $dataPelanggan->pelanggan_id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus pelanggan ini? Semua file terkait juga akan dihapus.')">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Lengkap</th>
                                <td>{{ $dataPelanggan->first_name }} {{ $dataPelanggan->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $dataPelanggan->birthday }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $dataPelanggan->gender }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $dataPelanggan->email }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $dataPelanggan->phone }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Form Upload File -->
                    <div class="col-md-6">
                        <h5>File Pendukung</h5>
                        <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ref_table" value="pelanggan">
                            <input type="hidden" name="ref_id" value="{{ $dataPelanggan->pelanggan_id }}">

                            <div class="mb-3">
                                <label for="filename" class="form-label">Upload File</label>
                                <input type="file" class="form-control" name="filename[]" multiple required>
                                <div class="form-text">Format: doc, docx, PDF, jpg, jpeg, png (Max: 2MB)</div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload me-1"></i> Upload File
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Daftar File -->
                <div class="row">
                    <div class="col-12">
                        <h5>Daftar File Terupload</h5>
                        @if($dataPelanggan->files->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="40%">NAMA FILE</th>
                                            <th width="20%">TANGGAL UPLOAD</th>
                                            <th width="40%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataPelanggan->files as $file)
                                        <tr>
                                            <td>
                                                @if(in_array(pathinfo($file->filename, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset('images/' . $file->filename) }}" alt="{{ $file->filename }}" width="50" class="me-2">
                                                @else
                                                    <i class="fas fa-file me-2 text-muted"></i>
                                                @endif
                                                {{ $file->filename }}
                                            </td>
                                            <td>
                                                {{ $file->created_at ? $file->created_at->format('d/m/Y H:i') : 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Tombol View -->
                                                    <a href="{{ asset('images/' . $file->filename) }}" target="_blank"
                                                       class="btn btn-info btn-sm" title="Lihat File">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>

                                                    <!-- Tombol Download -->
                                                    <a href="{{ asset('images/' . $file->filename) }}" download
                                                       class="btn btn-success btn-sm" title="Download File">
                                                        <i class="fas fa-download me-1"></i> Download
                                                    </a>

                                                    <!-- Tombol Delete -->
                                                    <form action="{{ route('uploads.destroy', $file->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Hapus file ini?')" title="Hapus File">
                                                            <i class="fas fa-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>Belum ada file yang diupload.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-group .btn {
    margin: 0 2px;
    border-radius: 4px;
}
.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>
@endsection
