@extends('layouts.dashboard_sidebar_and_navbar')

@section('content')

<br>
<br>

<div class="navbar-wrapper">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
      
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-success">
            <h4 class="card-title mt-0"> Users</h4>
            <p class="card-category"> Here is the list of all the users</p>
            <button class="btn btn-secondary btn-fab btn-fab-mini btn-round pull-right" data-toggle="modal" data-original-title="Remove" data-target="#add_informal_collector">
              <i class="material-icons">person_add</i>
            </button>
            <a href="{{ route('export_users') }}" class="btn btn-fab-mini btn-secondary btn-round">export table to excel</a>

          </div>
          <div class="card-body">
            <div class="modal fade" id="add_informal_collector" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Informal Collector</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{ route('informal_collector.store') }}" method="POST" class="form-group">
                      @csrf
                      <div class="modal-body">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname" class="form-control">
                        <label for="phone_no">Phone</label>
                        <input type="number" name="phone_no" id="phone_no" class="form-control">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>                     
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Activate User</th>
                        {{-- <th scope="col">Status</th> --}}
                        <th>Action</th>
                      </tr>
                    </thead>
  
                    @if (count($users)>0)
                      @foreach ($users as $user)
                      <tbody>
                          <tr>
                            <td>
                              
                              @if ($user->profile_type == null)
                                 {{$user->name}} (<a href="{{ asset("/storage/informal_collector.png") }}" target="_blank">qrcode</a>)
                              @else
                                 {{ $user->name }}
                              @endif
                            </td>
                            <td>{{$user->surname}}</td>
                            <td>
                              @if ($user->profile_type == null)
                                 N/A
                              @else
                                 {{ $user->email }}
                              @endif
                            </td>
                            <td>
                              @if ($user->profile_type == "App\Resident")
                                  Resident 
                              @endif
                              @if ($user->profile_type == "App\Admin")
                                  Admin
                              @endif
                              @if ($user->profile_type == "App\IndependentCollector")
                                  Independent Collector 
                              @endif
                              @if ($user->profile_type == "App\BuyBackCenter")
                                  BuyBack Center
                              @endif
                              @if ($user->profile_type == "App\PickItUpCenter")
                                  Pick It Up Employee 
                              @endif
                              @if ($user->profile_type == null)
                                  Informal Collector
                              @endif
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>

                              @if ($user->profile_type == "App\IndependentCollector" || $user->profile_type == "App\BuyBackCenter" )
                                <form action="{{ route('activate', $user->id) }}">
                                  @csrf
                                  @method('PUT')
                                  
                                  <input type="hidden" name="active" id="active" value="{{ $user->active }}">

                                  
                                  <button class="btn btn-sm rounded-0 {{ $user->active == "active"? 'btn-success' : 'btn-warning' }}"
                                    value="test"
                                    onclick="confirm('Please confirm this action ')">{{ $user->active }}</button>
                                </form>
                              @else
                                  <p>N/A</p>
                              @endif
                            </td>
                            {{-- <td>
                                @if ($user->user_type == "Independent Collector")
                                    {{ $user->active }}
                                @else
                                    <p>N/A</p>
                                @endif
                                                              
                            </td> --}}
                            <td>
                                <a href="{{ route('users.show', $user->id) }}"><i class="material-icons">visibility</i></a>                               
                            </td>
                          </tr>
                      </tbody>
                      @endforeach
                    @else
                    <tbody>
                        <tr>
                        
                            <td>
                            <h4 class="text text-center text-info">No users to display yet</h4>
                            </td>

                        </tr>
                    </tbody>
                    @endif
                    
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <hr>

    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-tabs card-header-success">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Requests</span>
                <a href="{{ route('export_requests') }}" class="btn btn-fab-mini btn-secondary btn-round">export table to excel</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="profile">
                <table class="table">
                    <tbody>
                      @if (count($requests)>0)
                        @foreach ($requests as $request)
                          
                            <tr>
                              <td>Id: {{ $request->id }}</td>
                              <td>Material Type :{{ $request->material_type }}</td>
                              <td>Quantity :{{ $request->material_quantity }}</td>
                              <td>Value :R{{ $request->collection_value }}</td>
                              <td>Date Requested :{{ $request->created_at }}</td>

                              <td>Status: @if ($request->collection_status == "purchased")
                                <span class="badge badge-primary">{{$request->collection_status}}</span>
                              @else
                                <span class="badge badge-info">{{ $request->collection_status }}</span>
                              @endif</td>
                            </tr>
                        @endforeach
                      @else
                      <tr>
                          <td>No data</td>
                      <tr>
                      @endif
                    </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    
    </div>


    <hr>

    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-tabs card-header-success">
            <div class="nav-tabs-navigation">

              <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Illigal Dumping</span>
                <a href="{{ route('export_dumping_requests') }}" class="btn btn-fab-mini btn-secondary btn-round">export table to excel</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="profile">
                <table class="table">
                    <tbody>
                      @if (count($dumpings)>0)
                        @foreach ($dumpings as $dumping)
                          <tr>
                            <td>Id: {{ $dumping->id }}</td>
                            <td>Reported by : {{ $dumping->resident->user->name }} {{ $dumping->resident->user->surname }}</td>
                            <td>Address :{{ $dumping->address }}</td>
                            <td>Date :{{ $dumping->created_at }}</td>
                          </tr>
                        @endforeach
                      @else
                      <tr>
                          <td>No data</td>
                      <tr>
                      @endif
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>
@endsection