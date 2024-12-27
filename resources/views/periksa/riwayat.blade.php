@extends('layouts.dashDokter')
@section('content')
<div class="container">
    <h3>Riwayat Pemeriksaan</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Catatan</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $r)
            <tr>
                <td>{{ $r->tgl_periksa }}</td>
                <td>{{ $r->daftarPoli->pasien->nama }}</td>
                <td>{{ $r->catatan }}</td>
                <td>{{ number_format($r->biaya_periksa, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection