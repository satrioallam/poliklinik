@extends('layouts.login')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-12">
        <div class="card shadow-sm mt-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card-header text-center bg-primary text-white">
                <h4>Daftar Pasien Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pasien.register') }}" method="POST">
                    @csrf
                    <!-- Nama Lengkap -->
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan Alamat Lengkap" required>{{ old('alamat') }}</textarea>
                    </div>

                    <!-- No KTP -->
                    <div class="form-group mb-3">
                        <label for="no_ktp" class="form-label">No KTP</label>
                        <input type="number" name="no_ktp" id="no_ktp" class="form-control" placeholder="Masukkan No KTP" value="{{ old('no_ktp') }}" required>
                    </div>

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Masukkan No HP" value="{{ old('no_hp') }}" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100">Daftar</button>
                    </div>

                    <!-- Link Kembali ke Login -->
                    <div class="mt-3 text-center">
                        <small>Sudah punya akun? <a href="{{ route('pasien.loginForm') }}">Login di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
