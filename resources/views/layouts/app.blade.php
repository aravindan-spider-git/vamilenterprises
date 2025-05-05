<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Vamil Enterprises </title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="">
        <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/lightgallery/css/lightgallery.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    </head>
    <body>
    
        <!--*******************
            Preloader start
        ********************-->
        <div id="preloader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
        <!--*******************
            Preloader end
        ********************-->
    
        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">
    
            <!--**********************************
                Nav header start
            ***********************************-->
    
            <div class="nav-header">
            

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
    
    
    
            <!--**********************************
                Nav header end
            ***********************************-->
    
            <!--**********************************
                Chat box start
            ***********************************-->
    
            <!--**********************************
                Chat box End
            ***********************************-->
    
            <!--**********************************
                Header start
            ***********************************-->
            @include('partials.header')
    
            <!--**********************************
                Header end ti-comment-alt
            ***********************************-->
    
            <!--**********************************
                Sidebar start
            ***********************************-->
            @include('partials.sidenav')
    
            <!--**********************************
                Sidebar end
            ***********************************-->
    
            <!--**********************************
                Content body start
            ***********************************-->
            <main>
                <div class="content-body">
    
                        @yield('content')
                </div>
            </main>
            <!--**********************************
                Content body end
            ***********************************-->
    
            <!--**********************************
                Footer start
            ***********************************-->
            @include('partials.footer')
    
            <!--**********************************
                Footer end
            ***********************************-->
    
    
    
    
    
            <!--**********************************
               Support ticket button start
            ***********************************-->
    
            <!--**********************************
               Support ticket button end
            ***********************************-->
    
    
        </div>
        <!--**********************************
            Main wrapper end
        ***********************************-->
    
        <!--**********************************
            Scripts
        ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>
    </body>
        
    </html>
    
