<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Medilab Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('user')}}/assets/img/favicon.png" rel="icon">
    <link href="{{asset('user')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <!-- Vendor CSS Files -->
    <link href="{{asset('user')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('user')}}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">


    <link href="{{asset('user')}}/assets/css/style.css" rel="stylesheet">


</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
        <div class="container d-flex">
            <div class="contact-info mr-auto">
                <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">risyam23@gmail.com</a>
                <i class="icofont-phone"></i> +6282284908748
                <i class="icofont-google-map"></i> Padang, Sumatera Barat
            </div>
            <div class="social-links">
                <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
                <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto"><a href="javascript:void(0)">Sistem Pakar ISPA</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    @if (Route::has('login'))
                        @auth
                        <li><a href="{{route('home')}}">Home</a></li>
                        @else
                        <li><a href="{{route('login')}}">Login</a></li>
                        @if (Route::has('register'))
                        <li><a href="{{route('register')}}">Sign up</a></li>
                        @endif
                        @endauth
                    @else

                    @endif

                </ul>
            </nav><!-- .nav-menu -->



        </div>
    </header><!-- End Header -->

    @yield('hero')


    <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments" style="margin-top: 8rem !important">
        <div class="container">

            @yield('section-title')
            @yield('content')
            <div class="row">
            </div>

        </div>
    </section><!-- End Departments Section -->

    <!-- ======= Footer ======= -->
    {{-- <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="container">
            <div class="d-flex flex-column">
                <p>&copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved</p>
                <p>Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></p>
            </div>

        </div>
    </nav> --}}


    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('user')}}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{asset('user')}}/assets/vendor/venobox/venobox.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/counterup/counterup.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{asset('user')}}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('user')}}/assets/js/main.js"></script>

</body>

</html>
