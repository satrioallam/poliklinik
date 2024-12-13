@extends('layouts.login')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-12">
        <!-- Add this block to display errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <div class="card-header text-center mb-3">
                <h3>Login Pasien</h3>
                <p>Masukkan username dan password Anda</p>
            </div>
            <!-- Form Login -->
            <div class="card-body border rounded p-4">
                <form action="{{ route('pasien.login') }}" method="POST">
                    @csrf
                    <!-- Username -->
                    <div class="form-group mb-4">
                        <label for="username" class="form-label">Username (Nama Lengkap / No KTP)</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Nama Lengkap atau No KTP" required value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Password -->
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Password (No Telepon)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan No Telepon" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
                <!-- Button Daftar -->
                <div class="text-center">
                    <p>Belum punya akun?</p>
                    <a href="{{ route('pasien.registerForm') }}" class="btn btn-success w-100">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection