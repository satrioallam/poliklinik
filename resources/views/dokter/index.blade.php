@extends('layouts.dashAdmin')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0 text-center">Data Dokter</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>ID Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokter as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>{{ $d->no_hp }}</td>
                                <td>{{ $d->id_poli }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDokterModal{{ $d->id }}">
                                        Edit
                                    </button>
                                    <!-- Delete Button -->
                                    <form action="{{ route('dokter.destroy', $d->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Dokter -->
                            <div class="modal fade" id="editDokterModal{{ $d->id }}" tabindex="-1" aria-labelledby="editDokterLabel{{ $d->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDokterLabel{{ $d->id }}">Edit Data Dokter</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dokter.update', $d->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $d->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $d->alamat }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $d->no_hp }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_poli" class="form-label">ID Poli</label>
                                                    <input type="text" class="form-control" id="id_poli" name="id_poli" value="{{ $d->id_poli }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDokterModal">
                    Tambah Dokter
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Dokter -->
    <div class="modal fade" id="tambahDokterModal" tabindex="-1" aria-labelledby="tambahDokterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDokterLabel">Tambah Data Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dokter.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_poli" class="form-label">ID Poli</label>
                            <input type="text" class="form-control" id="id_poli" name="id_poli" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('no_hp').addEventListener('input', function (e) {
            let value = e.target.value;
            value = value.replace(/[^0-9]/g, '');
            e.target.value = value;
        });
    </script>
@endsection
