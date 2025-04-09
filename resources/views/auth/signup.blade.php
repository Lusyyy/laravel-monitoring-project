<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="login_assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="login_assets/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background: linear-gradient(135deg, #a8e6cf 0%, #ffd1dc 100%); height: 100vh;">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">

                <form action="{{ route('signup.submit') }}" method="POST"
                    class="login100-form validate-form flex-sb flex-w">
                    @csrf
                    <span class="login100-form-title p-b-53">
                        Create Account
                    </span>
                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Name
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="name" value="{{ old('name') }}" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="p-t-31 p-b-9">
                    </div>
                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Contact
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="contact" value="{{ old('contact') }}" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Email
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="email" name="email" value="{{ old('email') }}" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                            required>
                        <span class="focus-input100"></span>
                    </div>
                    @error('password')
                        <div class="feedback">
                            <div class="invalid-feedback"></div>
                            <small class="text-danger" style="font-size: 11px">{{ $message }}</small>
                        </div>
                        <br>
                    @enderror
                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Confirm Password
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password"
                            name="password_confirmation" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button type="submit" class="header-btn2 login100-form-btn">Save</button>
                    </div>

                    <div class="w-full text-center p-t-55">
                        <span class="txt2">
                            Have already an account?
                        </span>

                        <a href="#" class="txt2 bo1">
                            <a href="/" class="header-btn2">Log in here</a>
                        </a>
                    </div>
                    </a>
            </div>
            </form>
        </div>
    </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/vendor/bootstrap/js/popper.js"></script>
    <script src="login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="login_assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="login_assets/js/main.js"></script>

</body>

</html>