@extends('layouts.dashAdmin')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0 text-center">Data Poli</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($poli as $pl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pl->nama_poli }}</td>
                                <td>{{ $pl->keterangan }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editPoliModal{{ $pl->id }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('poli.delete', $pl->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Poli -->
                            <div class="modal fade" id="editPoliModal{{ $pl->id }}" tabindex="-1" aria-labelledby="editPoliLabel{{ $pl->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPoliLabel{{ $pl->id }}">Edit Data Poli</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('poli.update', $pl->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nama_poli" class="form-label">Nama Poli</label>
                                                    <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="{{ $pl->nama_poli }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $pl->keterangan }}</textarea>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPoliModal">
                    Tambah Poli
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Poli -->
    <div class="modal fade" id="tambahPoliModal" tabindex="-1" aria-labelledby="tambahPoliLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPoliLabel">Tambah Data Poli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('poli.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_poli" class="form-label">Nama Poli</label>
                            <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
