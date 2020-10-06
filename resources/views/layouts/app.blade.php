<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from layerdrops.com/novio/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2020 13:47:52 GMT -->
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>CleanApp - Recycling solution </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="icon" href={{ asset('assets/favicon.ico')  }}/>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <!-- ====== main style start ====== -->
   
    <link rel="stylesheet" type="text/css" href={{ asset('assets/style.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/effect.css')}}>
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/responsive.css')}}>

    {{-- For the file input --}}
    <link rel="stylesheet" type="text/css" href= {{ asset('assets/css/normalize.css') }} />
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/font-awesome.css') }} />

    <!-- CSS Files -->
     {{-- <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" /> --}}
    <!-- CSS Just for demo purpose, don't include it in your project -->
    


    <!-- ====== main style end ====== -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    <script src="https://js.stripe.com/v3/"></script>


</head>

<body>

    <div class="">
        @yield('content')
         
    </div>



    <div class="back2Top bg1"> <i class="fa fa-angle-up fa-2x cw"></i>
    </div>
    @include('sweetalert::alert')
    <script src={{ asset('assets/js/jquery-1.12.4.min.js')}}></script>
    <script src={{ asset('assets/js/html5lightbox/html5lightbox.js')}}></script>
    <script src={{ asset('assets/js/bootstrap.min.js')}}></script>
    <script src={{ asset('assets/js/owl.carousel.js')}}></script>
    <script src={{ asset('assets/js/numscroller-1.0.js')}}></script>
    <script src={{ asset('assets/js/jquery.countdown.min.js')}}></script>
    <script src={{ asset('assets/js/jquery.enllax.min.js')}}></script>
    <script src={{ asset('assets/js/isotope.js')}}></script>
    <script src={{ asset('assets/js/magnific-popup.js')}}></script>
    <script src={{ asset('assets/js/main.js')}}></script>
    
    <script src="{{asset('js/script.js')}}"></script>
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANrsKzpVrZCHD0SAcBN-vNEx7f7ARF_g0&libraries=places"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js " charset="ut-8"></script>
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    
    
</body>