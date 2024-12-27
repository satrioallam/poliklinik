@extends('layouts.dashPasien')
@section('content')
<div class="container">
    <h1>Jadwal Dokter</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($jadwal->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                    <tr>
                        <td>{{ $item->dokter->nama }}</td>
                        <td>{{ $item->dokter->poli->nama_poli }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                        <td>
                            <a href="{{ route('poli.daftar.form', $item->id) }}" class="btn btn-primary">Daftar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada jadwal dokter yang aktif.</p>
    @endif
</div>
@endsection