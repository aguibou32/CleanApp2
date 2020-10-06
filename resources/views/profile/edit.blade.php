@extends('layouts.dashboard_sidebar_and_navbar')

@section('content')
<br>
<br>

<div class="navbar-wrapper">
  
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
        <li class="breadcrumb-item" data-color="green"><a href="">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
    </ol>
    </nav>
</div>

@can('isBuyBackCenter') 
  @if ($user->profile->ck_file == null)
  <div class="container">
    <div class="alert alert-info alert-with-icon" data-notify="container">
      <i class="material-icons" data-notify="icon">add_alert</i>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
      </button>
      <span data-notify="message">Please upload the following missing documents:
        <ul>
          @if ($user->profile->ck_file == null)
            <li>
             CK Certificate
            </li>
          @endif
        </ul>
      </span>
    </div>
  </div>
  @endif

@endcan

@can('isIndependentCollector')  
  @if ($user->profile->identification == null || $user->profile->criminal_record == null || $user->profile->driver_license == null )
    <div class="container">
      <div class="alert alert-info alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">add_alert</i>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="material-icons">close</i>
        </button>
        <span data-notify="message">Please upload the following missing documents:
          <ul>
            @if ($user->profile->identification == null)
              <li>
               identification
              </li>
            @endif

            @if ($user->profile->criminal_record == null)
              <li> 
               criminal record
              </li>
            @endif
            
            @if ($user->profile->driver_license == null)
              <li>
                driving license
              </li>
            @endif
          </ul>
        </span>
      </div>
    </div>
  @endif
  <br>
@endcan

<div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <p><h4 class="card-title">{{ $user->name }} Profile 
            
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
              
              @csrf
              @method('PUT')

              <h2>General Info</h2>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group bmd-form-group">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">   
                                     
                    <input type="text" class="form-control" name="surname" id="surname" value="{{ $user->surname }}" required >
                  </div>
                </div>
                
                <div class="col-md-4">
                  <label for="gender" class="col-form-label text-md-right">Gender</label>
                  <select name="gender" id="gender" class="form-control" value="{{ old('gender') }}">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <div class="form-group">     
                    <label for="email" class="col-form-label text-md-right">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group"> 
                    <label for="phone_no">Phone no</label>                   
                    <input type="phone_no" class="form-control" name="phone_no" id="phone_no" value="{{ $user->phone_no }}" required>
                  </div>
                </div>

              </div>

              <hr>
              <h2>Location address information</h2>
    
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="unit_number">Unit Number</label>
                    <input type="text" class="form-control" name="unit_number" id="unit_number" value="{{ $user->address->unit_number }}" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="complexe_name">Complexe Names</label>
                    <input type="text" class="form-control" name="complexe_name" id="complexe_name" value="{{ $user->address->complexe_name }}" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="complexe_name">Street name</label>
                    <input type="text" class="form-control" name="street_name" id="street_name" value="{{ $user->address->street_name }}" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="province_name">Province name</label>
                    <input type="text" class="form-control" name="province_name" id="province_name" value="{{ $user->address->province_name }}" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="city_name">City Name</label>
                    <input type="text" class="form-control" name="city_name" id="city_name" value="{{ $user->address->city_name }}" required>
                  </div>
                </div>

                
              </div>
              
              <div class="row">                  
                <div class="col-md-12 p-3">
                    <div class="box">
                      <label for="profile_picture">Profile picture</label>
                      <input type="file" name="profile_picture" id="profile_picture" class="inputfile" />

                      @error('profile_picture')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                    </div>
                </div>
              </div>
              <div class="dropdown-divider"></div>

              @if ($user->active == "deactive")
                  <div class="row">
                @can('isIndependentCollector')
                <h3 class="pl-3">Driver's section <small class="text text-danger text-small">(only pdf format files allowed)</small></h3> 
                  <div class="col-md-12 ml-1">
                    <div class="box">
                      <label for="identification_file">Identification</label>
                      <input type="file" name="identification_file" id="identification_file" class="inputfile" />

                      @error('identification')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-12 ml-2 p-2">
                    <div class="box">
                      <label for="criminal_record_file">Criminal Record</label>
                      <input type="file" name="criminal_record_file" id="criminal_record_file" class="inputfile" />
                    </div>
                  </div>

                  <div class="col-md-12 ml-1">
                    <div class="box">
                      <label for="driver_license_file">Driver License</label>
                      <input type="file" name="driver_license_file" id="driver_license_file" class="inputfile" />
                    </div>
                  </div>
                @endcan

                @can('isBuyBackCenter')
                  <h3 class="pl-3">Buy back centers' section <small class="text text-danger text-small">(only pdf format files allowed)</small></h3> 
                  <div class="col-md-12 ml-1">
                    <div class="box">
                      <label for="driver_license_file">CK Certificate</label>
                      <input type="file" name="ck_file" id="ck_file" class="inputfile" />
                        @error('ck_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
            
                    </div>
                  </div>
                @endcan
              </div>
              @endif
                
              <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>

      </div>
      
      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">
              <img class="img" src="{{ $user->profile_picture =="avatar.png" ? asset('storage/profile pictures/avatar.png') : asset('storage/' . $user->profile_picture ) }}" > 
          </div>
          <div class="card-body">
            <h4 class="card-title">{{ $user->name }} {{ $user->surname }}</h4>
            <h6 class="card-category text-gray">{{ $user->user_type }} ( created on : {{ $user->created_at }} )</h6>

            @can('isIndependentCollector')
              <p class="card-description"> status: 
                  <span class="text text-primary font-weight-bold">{{ $user->active }}</span>
              </p>
            @endcan
            @can('isBuyBackCenter')
            <p class="card-description"> status: 
                <span class="text text-primary font-weight-bold">{{ $user->active }}</span>
            </p>
          @endcan
         
          </div>
        </div>
      </div>
    </div>
  </div>  
@endsection