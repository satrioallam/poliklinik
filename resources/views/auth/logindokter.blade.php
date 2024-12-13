@extends('layouts.login')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-12">
        <div class="form-container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card-header text-center mb-3">
                <h3>Login Dokter</h3>
                <p>Masukkan username dan password Anda</p>
            </div>
            <div class="card-body border rounded p-4">
                <form action="{{ route('dokter.login') }}" method="POST">
                    @csrf

                    <!-- Username -->
                    <div class="form-group mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Nama Dokter" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan No Telepon" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection