@extends('layouts.dashDokter')
@section('content')

<div class="container">

    <h2>Daftar Pasien untuk Pemeriksaan</h2>

    <div class="row">
        <div class="col">
            {{-- Display Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Display Error Message --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Poli</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($daftarPoli as $data)
                    <tr>
                        <td>{{ $data->pasien->nama }}</td>
                        <td>{{ $data->keluhan }}</td>
                        <td>{{ $data->jadwalPeriksa->hari }} - {{ $data->jadwalPeriksa->jam_mulai }}</td>
                        <td>{{ $data->jadwalPeriksa->dokter->poli->nama_poli }}</td>
                        <td>
                            <a href="{{ route('periksa.form', $data->id) }}" class="btn btn-primary">Periksa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection