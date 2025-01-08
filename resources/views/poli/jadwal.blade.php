@extends('layouts.dashPasien')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pendaftaran Poli</h5>
                </div>
                <div class="card-body">
                    <form id="registrationForm" action="{{ route('poli.daftar') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor RM</label>
                            <input type="text" class="form-control" value="{{ $pasien->no_rm }}" readonly disabled>
                        </div>

                        <div class="mb-3">
                            <label for="poli" class="form-label">Pilih Poli</label>
                            <select class="form-select" id="poli" name="poli_id" required onchange="updateDoctors(this.value)">
                                <option value="">Pilih Poli</option>
                                @foreach($poli as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dokter" class="form-label">Pilih Dokter</label>
                            <select class="form-select" id="dokter" name="id_dokter" required onchange="updateSchedule(this.value)">
                                <option value="">Pilih Dokter</option>
                            </select>
                        </div>

                        <input type="hidden" id="id_jadwal" name="id_jadwal">

                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Jadwal Tersedia</label>
                            <div id="jadwal-info" class="form-text">
                                Pilih dokter terlebih dahulu
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Riwayat Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Nomor Antrian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $r)
                                    <tr>
                                        <td>{{ $r->jadwalPeriksa->dokter->poli->nama_poli }}</td>
                                        <td>{{ $r->jadwalPeriksa->dokter->nama }}</td>
                                        <td>{{ $r->jadwalPeriksa->hari }}</td>
                                        <td>{{ $r->jadwalPeriksa->jam_mulai }}</td>
                                        <td>{{ $r->jadwalPeriksa->jam_selesai }}</td>
                                        <td>{{ $r->no_antrian }}</td>
                                        <td>
                                            @if($r->periksa)
                                                <span class="badge bg-success">Sudah Diperiksa</span>
                                            @else
                                                <span class="badge bg-warning">Belum Periksa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $r->id }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailModal{{ $r->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $r->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel{{ $r->id }}">Detail Pendaftaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($r->periksa)
                                                        <p><strong>Tanggal Periksa:</strong> {{ $r->periksa->tgl_periksa }}</p>
                                                        <p><strong>Catatan:</strong> {{ $r->periksa->catatan }}</p>
                                                        <p><strong>Daftar Obat:</strong></p>
                                                        <ul>
                                                            @foreach($r->periksa->detailPeriksa as $detail)
                                                                <li>{{ $detail->obat->nama_obat }} - {{ $detail->obat->harga }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <p><strong>Biaya Periksa:</strong> {{ $r->periksa->biaya_periksa }}</p>
                                                    @else
                                                        <p><strong>Keluhan:</strong> {{ $r->keluhan }}</p>
                                                        <p><strong>Jadwal:</strong> {{ $r->jadwalPeriksa->hari }}, {{ $r->jadwalPeriksa->jam_mulai }} - {{ $r->jadwalPeriksa->jam_selesai }}</p>
                                                        <p><strong>Nomor Antrian:</strong> {{ $r->no_antrian }}</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    </div>
</div>

<script>
function updateDoctors(poliId) {
    fetch(`/get-doctors/${poliId}`)
        .then(response => response.json())
        .then(doctors => {
            const select = document.getElementById('dokter');
            select.innerHTML = '<option value="">Pilih Dokter</option>';
            doctors.forEach(doctor => {
                select.innerHTML += `<option value="${doctor.id}">${doctor.nama}</option>`;
            });
            select.disabled = false;
            document.getElementById('jadwal-info').textContent = 'Pilih dokter terlebih dahulu';
            document.getElementById('id_jadwal').value = '';
        });
}

function updateSchedule(doctorId) {
    fetch(`/get-schedule/${doctorId}`)
        .then(response => response.json())
        .then(schedule => {
            const jadwalInfo = document.getElementById('jadwal-info');
            const idJadwal = document.getElementById('id_jadwal');
            if (schedule) {
                jadwalInfo.textContent = `Hari: ${schedule.hari}, Jam: ${schedule.jam_mulai} - ${schedule.jam_selesai}`;
                idJadwal.value = schedule.id;
            } else {
                jadwalInfo.textContent = 'Tidak ada jadwal tersedia';
                idJadwal.value = '';
            }
        });
}
</script>
@endsection