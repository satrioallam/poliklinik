@extends('layouts.dashDokter')
@section('content')
<div class="container">
    <h1>Edit Data Diri</h1>
    <form action="{{ route('dokter.edit', $dokter->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $dokter->nama }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $dokter->no_hp }}" required>
        </div>
        <div class="form-group">
            <label for="id_poli">Poli:</label>
            <select name="id_poli" id="id_poli" class="form-control" readonly disabled>
                <option value="1" {{ $dokter->id_poli == 1 ? 'selected' : '' }}>Poli Umum</option>
                <option value="2" {{ $dokter->id_poli == 2 ? 'selected' : '' }}>Poli Gigi</option>
                <!-- Tambahkan opsi lainnya -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection