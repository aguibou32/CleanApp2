@extends('layouts.dashboard_sidebar_and_navbar')
@section('content')
  <br>
  <br>
  <br>
  <div class="container"> 
    
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Request Collection</h4>
            </div>
            <div class="card-body">

              
              <form method="POST" action="{{ route('requests.store') }}">
                @csrf
                <div class="form-group">
                   <label for="request_profile_type">Type of requests</label>
                   <select name="request_profile_type" id="request_profile_type" class="form-control">
                     <option value="RecyclingRequest"> Recycling Request</option>
                     <option value="PickItUpRequest"> PickItUp Request</option>
                   </select>
                </div>

               <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" name="name" id="name" class="form-control" value="@auth {{ Auth::user()->name }} @endauth " disabled>
               </div>

               <div class="form-group">
                 <label for="surname">Surname</label>
                 <input type="text" name="surname" id="surname" class="form-control" value=" @auth {{ Auth::user()->surname }} @endauth " disabled>
               </div>

               <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" name="email" id="email" class="form-control" value=" @auth {{ Auth::user()->email }} @endauth " disabled>
               </div>
             
              <div class="form-group">
                   <label for="phone_no">Phone Number</label>
                   <input type="text" name="phone_no" id="phone_no" class="form-control" value=" @auth {{ Auth::user()->phone_no }} @endauth " >
              </div>

              <div class="form-group">
                   <label for="address">Collection Address</label>
                   <input type="text" name="address" id="address" class="form-control" value="@auth {{ Auth::user()->address->unit_number }}, {{ Auth::user()->address->complexe_name }}, {{ Auth::user()->address->city_name }} @endauth ">
               </div>
               
              <div class="form-group">
                   <label for="material_type">Type of recyblable</label>
                   <select name="material_type" id="material_type" class="form-control">
                     <option value="plastic bottles">plastic materials</option>
                     <option value="glass bottles"> glass materials</option>
                     <option value="glass bottles"> can materials (metalic)</option>
                   </select>
              </div>
              
              <div class="form-group">
               <label for="material_quantity">Quantity</label>
                <input class="form-control @error('material_quantity') is-invalid @enderror" id="material_quantity" name="material_quantity" type="number" class="form-control">
                <small class="text text-danger"> minimum quantity is 50 bottles </small>
              
                 @error('material_quantity')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                   @enderror

               </div>
              
             <div class="form-group">                    
                 <button type="submit" class="btn btn-primary">
                     {{ __('Request') }}
                 </button>
           </div>
           </form>


            </div>
        </div>
      </div>
    </div>
  </div>
    
    
  

 
@endsection