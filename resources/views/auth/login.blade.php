<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('srtdash/assets/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('srtdash/assets/css/responsive.css') }}">
    <script src="{{ asset('srtdash/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <head>

        <style>
            body,
            html {
                height: 100%;
                margin: 0;
            }

            .login-area {
                position: relative;
                background: url('{{ asset('bg.jpg') }}') no-repeat center center fixed;
                background-size: cover;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-area::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1;
            }

            .container {
                position: relative;
                z-index: 2;
            }

            .logo-jti-wrapper {
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 3;
                background-color: white;
                border-radius: 50%;
                padding: 10px;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
                display: inline-block;
                width: 140px;
                overflow: visible;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo-jti {
                width: 120px;
                height: auto;
                display: block;
            }



            #loginForm {
                border-radius: 10px;
            }

            .login-form-head {
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                background-color: #815ef6;
            }
        </style>
    </head>

</head>

<body>

    <div class="logo-jti-wrapper">
        <img src="{{ asset('jti.png') }}" alt="Logo JTI" class="logo-jti">
    </div>


    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area">
        <div class="container">
            <div class="login-box">
                <form id="loginForm" method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>Login</h4>
                        <p>Silakan login untuk melanjutkan ke website kami</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" required>
                            <i class="ti-email"></i>
                            <div class="text-danger" id="usernameError"></div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                            <i class="ti-lock"></i>
                            <div class="text-danger" id="passwordError"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="{{ url('register') }}">Sign up</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('srtdash/assets/js/scripts.js') }}"></script>

    <!-- AJAX Login -->
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting normally
                let formData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    _token: $('input[name="_token"]').val()
                };

                $.ajax({
                    url: "{{ url('login') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            window.location.href = response.redirect;
                        } else {
                            alert(response.message || 'Login Gagal');
                        }
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan.");
                    }
                });
            });
        });
    </script>
</body>

</html>
