@extends('layouts.dashboard_sidebar_and_navbar')

@section('content')
<br>
<br>
<div class="navbar-wrapper">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
        <li class="breadcrumb-item" data-color="green"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
    </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header card-header-success">
            <p><h4 class="card-title">{{ $user->name }} Profile ( created at : {{ $user->created_at }} )
            
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">                    
                    <input type="text" class="form-control" value="name: {{ $user->name }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">                    
                    <input type="text" class="form-control" value="surname: {{ $user->surname }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">                    
                    <input type="email" class="form-control" value="email: {{ $user->email }}" disabled>
                  </div>
                </div>
                
              </div>
              
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" value="unit : {{ $user->address->unit_number }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" value="complexe name : {{ $user->address->complexe_name }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" value="street name : {{ $user->address->street_name }}" disabled>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" value="city : {{ $user->address->city_name }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control" value="province : {{ $user->address->province_name }}" disabled>
                  </div>
                </div>
              </div>
             
              <div class="row">
                  
                @if($user->profile_type == "App\IndependentCollector")

                  <div class="col-md-12">
                    <h3>Identification:</h3>
                    @if ($user->profile->identification != null)
                      <input type="hidden" value="{{ $file = $user->profile->identification }}">
                      <iframe src="{{asset("storage/$file") }}" width="100%" height="500px">
                      </iframe>
                    @else
                      <p class="text text-info"> No identification file uploaded yet </p>
                    @endif
                  </div>
                  
                  <div class="col-md-12">
                      <h3>Criminal Record:</h3>  
                      @if ($user->profile->criminal_record != null)
                      <input type="hidden" value="{{ $file = $user->profile->criminal_record }}">
                        <iframe src="{{URL::asset("storage/$file")}}" width="100%" height="500px">
                        </iframe>

                      @else
                          <p class="text text-info"> No criminal record uploaded yet</p>
                      @endif
                  </div>
                  
                  <div class="col-md-12">
                    <h3>Driver License:</h3>
                    @if ($user->profile->driver_license != null)
                      <input type="hidden" value="{{ $file = $user->profile->driver_license }}">
                      <iframe src="{{URL::asset("storage/$file")}}" width="100%" height="500px">
                      </iframe>
                        
                    @else
                      <p class="text text-info"> No driver license uploaded yet</p>
                    @endif  
                  </div>              
                @endif

                @if($user->profile_type == "App\BuyBackCenter")
                  <div class="col-md-12">
                    <h3>Identification:</h3>
                    @if ($user->profile->ck_file != null)
                      <input type="hidden" value="{{ $file = $user->profile->ck_file }}">
                      <iframe src="{{asset("storage/$file") }}" width="100%" height="500px">
                      </iframe>
                    @else
                      <p class="text text-info"> No ck certificate uploaded yet </p>
                    @endif
                  </div>
                @endif
             </div>
              <br>
              <br>
              {{-- <button type="submit" class="btn btn-success pull-right">Activate Profile</button> --}}
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <br>
  <br>
  <br>
  <br>
  <br>
@endsection