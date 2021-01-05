<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon.png')}}">
    <!-- Primary Meta Tags -->
    <title>E-Pengadaan | Halaman login</title>

    <meta name="title" content="Judul Sistem">
    <meta name="description" content="Deskripsi sistem anda">
    <meta name="keywords" content="keyword, sistem, anda, silahkan, diubah" />
    <meta name="author" content="Abidurrahman Al-Faruq" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:title" content="Judul Sistem">
    <meta property="og:description" content="Deskripsi sistem anda">
    <meta property="og:image" content="{{asset('img/favicon.png')}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="website">
    <meta property="twitter:url" content="{{ route('index') }}">
    <meta property="twitter:title" content="Judul Sistem">
    <meta property="twitter:description" content="Deskripsi sistem anda">
    <meta property="twitter:image" content="{{asset('img/favicon.png')}}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('plugins/ionicons/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="limiter">
    <div class="container-login100">
        <div class="login-box">
            <div class="register-logo">
                <a href="#" style="color: #fefefe;"><img src="{{asset('img/favicon.png')}}" width="100px"></a>
            </div>
            <!-- /.login-logo -->

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Sistem</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @error('active')
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        @error('username')
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        @error('password')
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-at"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script>
    $(document).ready(function () {
        jQuery.extend(jQuery.validator.messages, {
            required: "Kolom ini tidak boleh kosong.",
            email: "Email tidak valid.",
        });
        $('form').validate({
            onkeyup: false,
            rules: {
                username: {
                    required: true,
                },
                sandi: {
                    required: true,
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>
