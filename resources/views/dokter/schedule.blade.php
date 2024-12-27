@extends('layouts.dashDokter')

@section('content')
<div class="container">
    <h1>Kelola Jadwal Periksa</h1>

    <form action="{{ route('dokter.schedule', $dokter->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group mb-3">
            <label for="hari">Hari:</label>
            <select name="hari" id="hari" class="form-control" required>
                <option value="">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Simpan Jadwal
        </button>
    </form>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title mb-0">Daftar Jadwal</h2>
        </div>
        <div class="card-body">
            @if ($jadwal->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ date('h:i A', strtotime($item->jam_mulai)) }}</td>
                                    <td>{{ date('h:i A', strtotime($item->jam_selesai)) }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                            <i class="fas {{ $item->status == 'Aktif' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $activeCount = $jadwal->where('status', 'Aktif')->count();
                                        @endphp
                                        
                                        @if($item->status == 'Aktif')
                                            <button class="btn btn-success btn-sm" disabled>
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </button>
                                        @else
                                            <form action="{{ route('dokter.schedule.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="Aktif">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-power-off me-1"></i>Set Aktif
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Tidak ada jadwal tersedia.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.badge {
    font-size: 0.875rem;
    padding: 0.5em 0.75em;
}

.table > :not(caption) > * > * {
    padding: 0.75rem;
    vertical-align: middle;
}

.btn i {
    font-size: 0.875rem;
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection