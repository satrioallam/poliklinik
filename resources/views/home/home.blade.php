<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <title>PoliKlinik Udinus</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/font-awesome/css/font-awesome.min.css') }}">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 800px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-table {
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
        }

        .login-buttons a {
            width: 100%;
            margin-bottom: 10px;
        }

        .social-media i {
            font-size: 2rem;
            margin: 10px;
        }

        .social-media {
            margin-top: 20px;
        }

        .form-image {
            max-width: 120px;
            height: auto;
        }

        .description {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width: 30%; text-align:center;">
                    <img src="{{ asset('assets/img/favicon.png') }}" alt="Logo PoliKlinik" class="form-image">
                </td>
                <td>
                    <h2 class="mb-0">PoliKlinik</h2>
                    <h5>Universitas Dian Nuswantoro</h5>
                </td>
            </tr>
        </table>

        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="description">
                        <p class="lead">Selamat datang di PoliKlinik Udinus. Kami melayani dengan sepenuh hati untuk kesehatan dan kesejahteraan Anda. Poliklinik ini terbuka bagi mahasiswa, dosen, dan staf Universitas Dian Nuswantoro.</p>
                    </div>

                    <div class="login-buttons mb-4">
                        <h4 class="text-center mb-3">Silahkan Login</h4>
                        <a href="{{ route('dokter.loginForm') }}" class="btn btn-primary btn-block mb-2">Login Dokter</a>
                        <a href="{{ route('pasien.loginForm') }}" class="btn btn-success btn-block">Login Pasien</a>
                    </div>

                    <div class="social-media text-center">
                        <h5>Ikuti Kami di Media Sosial</h5>
                        <a href="#" target="_blank" class="mx-2"><i class="fa fa-facebook-square"></i></a>
                        <a href="#" target="_blank" class="mx-2"><i class="fa fa-twitter-square"></i></a>
                        <a href="#" target="_blank" class="mx-2"><i class="fa fa-instagram"></i></a>
                        <a href="#" target="_blank" class="mx-2"><i class="fa fa-youtube-play"></i></a>
                        <a href="#" target="_blank" class="mx-2"><i class="fa fa-telegram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
