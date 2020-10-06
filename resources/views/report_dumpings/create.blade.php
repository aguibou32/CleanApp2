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
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="row">
                <h1>Report Illigal Dumping</h1>
                <br>
                <br>
              <form method="POST" action="{{ route('report_dumping.store') }}" enctype="multipart/form-data">
                   @csrf

                 <div class="form-group">
                      <label for="address">Dumping Address</label>
                      <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                      @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                 </div>

                 <div class="box">
                      <label for="dumping_picture">Dumping picture</label>
                      <input type="file" name="dumping_picture" id="dumping_picture" class="inputfile" />

                      @error('dumping_picture')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                </div>

                 {{-- <div class="form-group">
                    <label for="dumping_picture">Dumping picture</label>
                    <input type="file" name="dumping_picture" class="form-control" value="{{old('dumping_picture')}}">
                    @error('dumping_picture')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div> --}}
                  
                <div class="form-group">                    
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Report') }}
                    </button>
                </div>
              </form>
          </div>
          <div class="col-md-3"></div>
      </div>
  </div>
    
  <br><br><br><br><br>
  
</body>