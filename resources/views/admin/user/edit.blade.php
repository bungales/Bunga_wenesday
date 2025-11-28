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
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit User</h1>
            <p class="mb-0">Form untuk mengedit data user.</p>
        </div>
        <div>
            <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">

                <form action="{{ route('user.update', $datauser->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-lg-4 col-sm-6">

                            {{-- Foto Profil --}}
                            @if($datauser->foto)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $datauser->foto) }}"
                                        style="width:120px; height:120px; object-fit:cover; border-radius:50%; border:3px solid #ccc;">
                                    <p class="mt-2">Foto Profil</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Ganti Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ $datauser->name }}"
                                       class="form-control" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control"
                                       value="{{ $datauser->email }}" name="email" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Opsional)</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            </div>

                            <!-- Buttons -->
                            <div class="">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

@endsection
