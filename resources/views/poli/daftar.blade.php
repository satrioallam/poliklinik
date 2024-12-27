@extends('layouts.dashPasien')
@section('content')
    <div class="container">
        <h1>Form Pendaftaran Poli</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5>Detail Jadwal:</h5>
                <p><strong>Dokter:</strong> {{ $jadwal->dokter->nama }}</p>
                <p><strong>Poli:</strong> {{ $jadwal->dokter->poli->nama_poli }}</p>
                <p><strong>Hari:</strong> {{ $jadwal->hari }}</p>
                <p><strong>Jam:</strong> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>

                <form action="{{ route('poli.daftar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">
                    <div class="form-group">
                        <label for="keluhan">Keluhan:</label>
                        <textarea name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" required>{{ old('keluhan') }}</textarea>
                        @error('keluhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                </form>
            </div>
        </div>
    </div>
@endsection