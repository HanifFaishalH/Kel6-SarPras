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
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form id="loginForm" method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Template</p>
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
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="{{ url('register') }}">Sign up</a></p>
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
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
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
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.redirect;
                        } else {
                            alert(response.message || 'Login Gagal');
                        }
                    },
                    error: function (xhr) {
                        alert("Terjadi kesalahan.");
                    }
                });
            });
        });
    </script>
</body>

</html>
