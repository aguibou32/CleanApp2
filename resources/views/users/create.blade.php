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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Register</h1>
            
            <div class="card">
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-3"></div>

                            <div class="col-md-9">
                                <label for="name" class="col-form-label text-md-right">{{ __('Name (or Company name)') }}</label>                               
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="surname" class="col-form-label text-md-right">{{ __('Surname (or company initials)') }}</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autofocus>
                        
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="gender" class="col-form-label text-md-right">{{ __('Gender') }}</label>
                                <select name="gender" id="gender" class="form-control" value="{{ old('gender') }}">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                        
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="phone_no" class="col-form-label text-md-right">{{ __('Phone number ') }}</label>
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" autocomplete="phone_no">
                        
                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="profile_type" class="col-form-label text-md-right">{{ __('Register As') }}</label>
                                <select name="profile_type" id="profile_type" class="form-control" value="{{ old('profile_type') }}">
                                    <option value="Resident">Resident</option>
                                    <option value="IndependentCollector">Independent Collector</option>
                                    <option value="PickItUpCenter">Pick It Up Center</option>
                                    <option value="BuyBackCenter">Buy Back Center</option>
                                </select>
                        
                                @error('profile_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="street_name" class="col-form-label text-md-right">{{ __('Street name ') }}</label>
                                <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}"  autocomplete="street_name">
                        
                                @error('street_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="unit_number">Unit N°</label>
                                    <input type="text" class="form-control" value="{{ old('unit_number') }}" name="unit_number" id="unit_number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="complexe_name">Complexe name</label>
                                    <input type="text" class="form-control" value="{{ old('complexe_name') }}" name="complexe_name" id="complexe_name">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="province_name">Province name</label>
                                    <input type="text" class="form-control" value="{{ old('province_name') }}" name="province_name" id="province_name">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="city_name">City name</label>
                                    <input type="text" class="form-control" value="{{ old('city_name') }}" name="city_name" id="city_name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>

</body>
