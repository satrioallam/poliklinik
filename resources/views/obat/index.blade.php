@extends('layouts.dashAdmin')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0 text-center">Data Obat</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Kemasan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $o)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $o->nama_obat }}</td>
                                <td>{{ $o->kemasan }}</td>
                                <td>{{ $o->harga }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editObatModal{{ $o->id }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('obat.delete', $o->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Obat -->
                            <div class="modal fade" id="editObatModal{{ $o->id }}" tabindex="-1" aria-labelledby="editObatLabel{{ $o->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editObatLabel{{ $o->id }}">Edit Data Obat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('obat.update', $o->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nama_obat" class="form-label">Nama Obat</label>
                                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ $o->nama_obat }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kemasan" class="form-label">Kemasan</label>
                                                    <input type="text" class="form-control" id="kemasan" name="kemasan" value="{{ $o->kemasan }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $o->harga }}" required>
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

            <!-- Button to open modal for adding new obat -->
            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahObatModal">
                    Tambah Obat
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="tambahObatModal" tabindex="-1" aria-labelledby="tambahObatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahObatLabel">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('obat.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                        </div>
                        <div class="mb-3">
                            <label for="kemasan" class="form-label">Kemasan</label>
                            <input type="text" class="form-control" id="kemasan" name="kemasan" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Format harga input
        document.getElementById('harga').addEventListener('input', function (e) {
            let value = e.target.value;
            value = value.replace(/[^0-9]/g, '');
            e.target.value = 'Rp ' + new Intl.NumberFormat().format(value);
        });
    </script>
@endsection
