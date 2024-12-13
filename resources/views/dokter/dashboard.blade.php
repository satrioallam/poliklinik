@extends('layouts.dashDokter')
@section('content')

    <body class="with-welcome-text">
        <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary text-white">
                <h4 class="mb-0">Data Poliklinik</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card card-custom shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">Dokter</h5>
                                <p class="card-text fs-3 fw-bold text-dark">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card card-custom shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">Pasien</h5>
                                <p class="card-text fs-3 fw-bold text-dark">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card card-custom shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title text-warning">Obat</h5>
                                <p class="card-text fs-3 fw-bold text-dark">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card card-custom shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title text-danger">Poli</h5>
                                <p class="card-text fs-3 fw-bold text-dark">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* Custom Card Styling */
                    .card-custom {
                        border-radius: 10px;
                        transition: all 0.3s ease-in-out;
                        background-color: #f8f9fa;
                    }

                    /* Stronger shadow effect */
                    .card-custom.shadow-lg {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
                    }

                    /* Hover effect for more interactivity */
                    .card-custom:hover {
                        transform: translateY(-10px);
                        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3), 0 12px 40px rgba(0, 0, 0, 0.22);
                    }

                    /* Typography adjustments */
                    .card-title {
                        font-size: 1.25rem;
                        font-weight: 600;
                    }

                    .card-text {
                        font-size: 2rem;
                    }
                </style>


            </div>
        </div>
    </body>
@endsection
