<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--plugins-->
    <link href="{{ ('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ ('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ ('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ ('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ ('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ ('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ ('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ ('assets/css/icons.css') }}" rel="stylesheet">

    <link href="{{ ('css/styles.css') }}" rel="stylesheet">

    <title>Titulo - Login</title>
</head>

<body style="background-color: #eaedf7;">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-lg-2">
                    <div class="col mx-auto">
                        <div class="card br-5" style="border-radius: 10px;">
                            <div class="card-body" >
<div class="row">
    <div class="col-lg-5 d-flex align-items-center justify-content-center">
        <img src="{{ asset('img/logo.png') }}" alt="" style="max-width: 80%;">
    </div>
    <div class="col-lg-7">
        <div class="p-4">
            <div class="text">
                <h6 class="">INICIAR SESIÓN</h6>
                <p style="color: #8f8fb1;font-size: 10pt;">
                    Inicie sesión para crear, descubrir y conectarse <b>Restaurant</b>
                </p>
            </div>
            <div class="d-grid" style="margin-bottom: 10px;">
               
            </div>

            <div class="form-body">
  
                    <form method="POST" class="row g-3" action="{{ route('login') }}">
                        @csrf

                    <div class="col-12">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Introduce tu correo electrónico" value="{{ old('email') }}" required name="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">Contraseña</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Ingresa tu contraseña" required name="password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Iniciar sesión
                            </button>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="col-12">
                        <a href="" style="color: #6259ca;">
                            ¿Se te olvidó tu contraseña?
                        </a>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>




                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ ('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ ('assets/js/jquery.min.js') }}"></script>
    <script src="{{ ('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ ('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ ('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ ('assets/js/app.js') }}"></script>
</body>

</html>