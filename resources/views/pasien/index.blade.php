
@extends('layouts.dashAdmin')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0 text-center">Data Pasien</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No KTP</th>
                            <th>No HP</th>
                            <th>No RM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasien as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->no_ktp }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>{{ $p->no_rm }}</td>
                                <td class="text-center">
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#editModal{{ $p->id }}">Edit</button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('pasien.delete', $p->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="editModalLabel">Edit Pasien</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('pasien.update', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $p->nama }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="alamat" class="form-control"
                                                        value="{{ $p->alamat }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>No KTP</label>
                                                    <input type="number" name="no_ktp" class="form-control"
                                                        value="{{ $p->no_ktp }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>No HP</label>
                                                    <input type="number" name="no_hp" class="form-control"
                                                        value="{{ $p->no_hp }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>No RM</label>
                                                    <input type="text" class="form-control" value="{{ $p->no_rm }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Pasien</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pasien.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No KTP</label>
                            <input type="number" name="no_ktp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="no_hp" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

