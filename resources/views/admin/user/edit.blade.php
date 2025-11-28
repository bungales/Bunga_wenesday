@extends('layouts.admin.app')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit User</h1>
            <p class="mb-0">Form untuk mengedit data user.</p>
        </div>
        <div>
            <a href="{{ route('user.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Error!</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-lg-4 col-sm-6">
                            <!-- Current Profile Picture -->
                            <div class="mb-3 text-center">
                                @if($user->profile_picture)
                                    <img src="{{ Storage::url($user->profile_picture) }}"
                                         alt="Profile Picture"
                                         class="rounded-circle shadow"
                                         width="120" height="120"
                                         style="object-fit: cover;">
                                    <p class="mt-2 text-muted">Foto Profil Saat Ini</p>

                                    <!-- Delete Profile Picture Button -->
                                    <div class="mt-2">
                                        <form action="{{ route('user.destroy.picture', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus foto profil?')">
                                                <i class="fas fa-trash me-1"></i> Hapus Foto
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 120px; height: 120px;">
                                        <i class="fas fa-user text-muted fa-3x"></i>
                                    </div>
                                    <p class="mt-2 text-muted">Belum ada foto profil</p>
                                @endif
                            </div>

                            <!-- New Profile Picture -->
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Ganti Foto Profil</label>
                                <input type="file" name="profile_picture" id="profile_picture"
                                       class="form-control" accept="image/*">
                                <div class="form-text">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</div>
                                @error('profile_picture')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                       class="form-control" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control"
                                       value="{{ old('email', $user->email) }}" name="email" required>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Opsional)</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Masukkan password baru">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control" placeholder="Konfirmasi password baru">
                                @error('password_confirmation')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript untuk menangani password confirmation
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password_confirmation');

    // Jika password dikosongkan, kosongkan juga confirm password
    passwordField.addEventListener('input', function() {
        if (this.value === '') {
            confirmField.value = '';
        }
    });
});
</script>

@endsection
