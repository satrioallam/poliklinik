@extends('layouts.dashDokter')
@section('content')
<div class="container">
    <h3>Pemeriksaan Pasien</h3>

    <!-- Display Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Patient Data -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Data Pasien</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $daftarPoli->pasien->nama }}</p>
                    <p><strong>No. RM:</strong> {{ $daftarPoli->pasien->no_rm }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Keluhan:</strong> {{ $daftarPoli->keluhan }}</p>
                    <p><strong>No. Antrian:</strong> {{ $daftarPoli->no_antrian }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Examination Form -->
    <form action="{{ route('periksa.store') }}" method="POST" id="formPeriksa">
        @csrf
        <input type="hidden" name="id_daftar_poli" value="{{ $daftarPoli->id }}">
        <input type="hidden" name="biaya_total" id="biayaTotal" value="150000">

        <!-- Examination Date -->
        <div class="mb-3">
            <label for="tgl_periksa" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control"
                   value="{{ old('tgl_periksa', date('Y-m-d')) }}" required>
        </div>

        <!-- Examination Notes -->
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan Pemeriksaan</label>
            <textarea name="catatan" id="catatan" rows="4" class="form-control" required
                      placeholder="Masukkan hasil pemeriksaan dan diagnosis">{{ old('catatan') }}</textarea>
        </div>

        <!-- Medicine Selection -->
        <div class="mb-3">
            <label for="obat" class="form-label">Obat yang Diberikan</label>
            <select name="id_obat[]" id="obat" class="selectpicker" multiple required>
                @foreach($obat as $o)
                <option value="{{ $o->id }}" data-harga="{{ $o->harga }}">
                    {{ $o->nama_obat }} ({{ $o->kemasan }}) - Rp {{ number_format($o->harga, 0, ',', '.') }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Cost Breakdown -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Rincian Biaya</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Biaya Pemeriksaan: <span class="biaya-pemeriksaan">Rp 150.000</span></p>
                        <p>Total Biaya Obat: <span id="totalObat">Rp 0</span></p>
                    </div>
                    <div class="col-md-6">
                        <h4>Total Biaya: <span id="totalBiaya">Rp 150.000</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Buttons -->
        <div class="text-end">
            <a href="{{ route('periksa.list') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const biayaPemeriksaan = 150000;
        let totalBiayaGlobal = biayaPemeriksaan;

        // Initialize Bootstrap Select
        $('#obat').selectpicker({
            liveSearch: true, // Enable search functionality
            multiple: true,   // Allow multiple selections
            width: '100%'     // Set width
        });

        // Function to format currency
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }

        // Calculate total when obat selection changes
        $('#obat').on('changed.bs.select', function(e) {
            let totalObat = 0;

            // Get selected options
            const selectedOptions = $(this).find('option:selected');

            // Calculate total from selected options
            selectedOptions.each(function() {
                const harga = parseInt($(this).data('harga')) || 0;
                totalObat += harga;
            });

            // Calculate total biaya (examination fee + medicine cost)
            totalBiayaGlobal = biayaPemeriksaan + totalObat;

            // Update display with formatted currency
            $('#totalObat').text(formatRupiah(totalObat));
            $('#totalBiaya').text(formatRupiah(totalBiayaGlobal));

            // Update hidden input with total
            $('#biayaTotal').val(totalBiayaGlobal);
        });

        // Form validation before submission
        $('#formPeriksa').on('submit', function(e) {
            const obat = $('#obat').val();
            const catatan = $('#catatan').val().trim();
            const biayaTotal = $('#biayaTotal').val();

            if (!catatan) {
                e.preventDefault();
                alert('Catatan pemeriksaan harus diisi!');
                return false;
            }

            if (!obat || obat.length === 0) {
                e.preventDefault();
                alert('Pilih minimal satu obat!');
                return false;
            }

            if (!biayaTotal) {
                e.preventDefault();
                alert('Total biaya tidak boleh kosong!');
                return false;
            }

            // If all validations pass, form will submit naturally
            return true;
        });
    });
</script>
@endpush