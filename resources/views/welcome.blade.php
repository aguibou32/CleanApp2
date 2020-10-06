@extends('layouts.app')

@section('content')
    
<div class="preloader"><div class="spinner"></div></div>
<!-- page-wrapper start -->
<div class="page-wrapper">
    <!-- header start -->
    @include('inc.header')
    <!-- header end -->
    <!-- main-slider start -->

    @include('inc.slider')
    <!-- main-slider end -->
    <!-- page-content start -->
    <div class="page-content">
        <div class="intro1 pb-100">
            <div class="container">
                <div class="row">
                    <div class="section-header text-center mb-60">
                        <h2 class="f2 c1">welcome to cleanApp</h2>
                        <h1 class="f1 fw-7 c4">Time to change the world</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- facts start -->
        
        <!-- facts end -->
    </div>
    <!-- page-content end -->
    <!-- footer start -->
    @include('inc.footer')
    <!-- footer end -->
</div>
<!-- page-wrapper end -->

</body>


<!-- Mirrored from layerdrops.com/novio/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2020 13:48:43 GMT -->
</html>
@endsection