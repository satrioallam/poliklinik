@extends('layouts.dashTest')
@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pasien</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No RM</th>
                            <th>Nama</th>
                            <th>No KTP</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periksa as $pasien)
                        <tr>
                            <td>{{ $pasien['no_rm'] }}</td>
                            <td>{{ $pasien['nama'] }}</td>
                            <td>{{ $pasien['no_ktp'] }}</td>
                            <td>{{ $pasien['no_hp'] }}</td>
                            <td>{{ $pasien['alamat'] }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal{{ $pasien['id'] }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Modal for each patient -->
                        <div class="modal fade" id="modal{{ $pasien['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $pasien['id'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $pasien['id'] }}">Detail Pasien: {{ $pasien['nama'] }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if(!empty($pasien['daftar_poli']))
                                            @foreach($pasien['daftar_poli'] as $daftarPoli)
                                                <p><strong>Nama Pasien:</strong> {{ $pasien['nama'] }}</p>
                                                <p><strong>Keluhan:</strong> {{ $daftarPoli['keluhan'] }}</p>
                                                @if(isset($daftarPoli['periksa']))
                                                    <p><strong>Catatan:</strong> {{ $daftarPoli['periksa']['catatan'] }}</p>
                                                    <p><strong>Obat:</strong>
                                                        @php
                                                            $obatList = [];
                                                            foreach ($daftarPoli['periksa']['detail_periksa'] as $detail) {
                                                                $obatList[] = $detail['obat']['nama_obat'];
                                                            }
                                                            echo implode(', ', $obatList);
                                                        @endphp
                                                    </p>
                                                @endif
                                                <hr>
                                            @endforeach
                                        @else
                                            <p>Belum pernah periksa</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection