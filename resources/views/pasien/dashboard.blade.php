@extends('layouts.dashPasien')
@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Selamat datang, {{ session('pasien_nama') }}!</h5>
                    <p>Ini adalah dashboard pasien.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection