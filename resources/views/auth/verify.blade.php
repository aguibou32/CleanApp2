<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        CleanApp dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
</head>

<body>
    <br>
            <br>
            <br>
            <br>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-7 pr-0">
                <div class="process-txt">
                    <div class="section-header">
                        <h1 class="f2 c2">Verify Your Email Address</h1>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                    <ul class="c4 f1 mt-55">
                        <li class="fw-6 mb-35 clearfix"> <span>Before proceeding, please check your email for a verification link. If you did not receive the email</span>
                        </li>
                    <li>
                        <span>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>
                            </form>
                        </span>
                    </li>

                    </ul>
                    <div class="process-img">
                        <img src="img/process/01.jpg" alt="">
                        <div class="customers bg3 c4 f1">
                            {{-- <h2 class="fw-4">4</h2> --}}
                            {{-- <span class="fw-6">Satisfied Customers</span> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
</body>

