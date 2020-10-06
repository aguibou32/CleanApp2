<div class="main-slider ms1">
    <div class="banner-carousel owl-carousel">
        <div class="ms1-item">
            <img src={{ asset('assets/images/slider/01.jpg') }} alt="">
            <div class="pos-r g-table">
                <div class="d-middle">
                    <div class="container crop">
                        <div class="item-inner"> <span class="slider-icon">
                                                    <i class="nivio-tree-leaf"></i>
                                                 </span>
                            <p class="f2 c3 fw-4">Request for collection and help us change the world</p>
                            <div class="head-lines f1 cw mb-55">
                                <h1 class="fw-7">Together we</h1>
                                <h1 class="fw-7">can make a</h1>
                                <h1 class="fw-7">difference</h1>
                            </div> 
                            
                            @guest
                                <a href="{{ route('register')}}" class="thm-btn hvr-2 bg3 c4">Start Today!</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms1-item">
            <img src={{ asset('assets/images/slider/02.jpg') }} alt="">
            <div class="pos-r g-table">
                <div class="d-middle">
                    <div class="container crop">
                        <div class="item-inner"> <span class="slider-icon">
        <i class="nivio-tree-leaf"></i>
      </span>
                            <p class="f2 c3 fw-4">Donate and help us change the world</p>
                            <div class="head-lines f1 cw mb-50">
                                <h1 class="fw-7">Together we</h1>
                                <h1 class="fw-7">can bring</h1>
                                <h1 class="fw-7">the change</h1>
                            </div> <a href="{{ route('register') }}" class="thm-btn hvr-3 bg1 cw">Start Recyling Today !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>