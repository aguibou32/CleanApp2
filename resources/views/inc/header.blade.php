<header class="header1">
    <nav class="navbar nav-solid mb-0">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu"> <span></span>  <span></span>  <span></span> 
                </button>
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <img src={{ asset('assets/images/logo/01.png') }} alt="logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="main-menu">
                {{-- <form class="navbar-left">
                    <input type="text" class="form-control" placeholder="Search">
                </form> --}}
                
                <ul class="nav navbar-nav navbar-right">

                   
                <li><a href="{{ route('report_dumping.create') }}">Report Illigal Dumping</a></li>
                <li><a href="{{ route('requests.create') }}">Request Collection</a></li>
                <li><a href="{{ route('requests.index') }}">Collection locations list</a></li>
                {{-- <li><a href="{{ route('googlemap.all') }}">All places</a></li> --}}
                {{-- <li><a href="{{ route('googlemap.create') }}">Create</a></li> --}}
                {{-- {{-- <li><a href="{{ route('googlemap.edit') }}">Edit Place</a></li> --}}
                {{-- <li><a href="{{ route('googlemap.preview') }}">Preview Place</a></li> --}}
                
                
                @guest
                <li class="nav-item">
                    <a class="nav-link p-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @endguest
                @auth
                
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} (
                                
                                @if (Auth::user()->profile_type == "App\Resident")
                                    Resident 
                                @endif

                                @if (Auth::user()->profile_type == "App\Admin")
                                    Admin 
                                @endif

                                @if (Auth::user()->profile_type == "App\IndependentCollector")
                                    Independent Collector 
                                @endif

                                @if (Auth::user()->profile_type == "App\BuyBackCenter")
                                    BuyBack Center
                                @endif

                                @if (Auth::user()->profile_type == "App\PickItUpCenter")
                                    Pick It Up Employee
                                @endif

                                )<span class="caret"></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>               
                <ul class="nav navbar-nav social-nav navbar-left">
                    <li>
                        <a href="#"> <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-youtube-play"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>