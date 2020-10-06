@extends('layouts.dashboard_sidebar_and_navbar')

@section('content')
  <br>
  <br>
  <br>
  @if (count($requests)>0)
    <div class="container"> 
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">List Of Collection Places</h4>
                </div>
                <div class="card-body">
                
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <thead>
                                <tr>
                                    <th class="text-left">Request Details</th>
                                    <th class="text-right"></th>
                                    <th class="th-description"></th>
                                    <th class="text-right"></th>
                                    <th class="text-right"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($requests as $request)
                                <tr>
                                    <td class="td-name">
                                        <div class="card-avatar">
                                            <img class="img rounded-circle" src="{{ $request->request->resident->user->profile_picture =="avatar.png" ? asset('storage/profile pictures/avatar.png') : asset('storage/' . $request->request->resident->user->profile_picture ) }}" style="width: 10%" >
                                        </div>
                                        <p>{{ $request->request->resident->user->name }} {{  $request->request->resident->user->surname }}</p>
                                        <small> Location:{{ $request->request->address }}</small> <br>
                                        <small>Phone: {{ $request->request->resident->user->phone_no }}</small> <br>
                                        <small>Recyclable type: {{ $request->material_type }}</small> <br>
                                        <br>
                                        <br>
                                        <small>
                                            <p class="">Posted on: {{ $request->created_at }}</p>
                                        </small>
                                        <span class="badge badge-info">Distance to your location: 14km</span>
                                    </td>
                                    <td>
                                        @if ( $request->collection_status == "purchased")
                                            <span class="badge badge-primary">delivered</span></p>
                                        @endif
                                    </td>
                                    <td>
                                        @can('isIndependentCollector')
                                            @if (Auth::user()->active == "active")
                                            <form method="POST" action="{{ route('collections.store') }}">
                                                @csrf
                                                <input type="hidden" name="collection_status" value="in progress">
                                                <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                <input type="hidden" name="collector_id" value="{{ Auth::user()->profile_id}}">
                                                                                                
                                                <td>
                                                    @if ($request->collection_status == 'requested')
                                                        <button type="submit" class="btn btn-primary">Mark Request as collected</button>
                                                    @endif
                                                </td>

                                            </form>
                                            @endif
                                             <br>
                                        @endcan
                                    </td>
                                    <td>
                                        @if ($request->collection_status == 'requested')
                                            <form action="{{ route('map') }}">
                                                <button type="submit" class="btn btn-primary">
                                                    navigate to this place
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    
                                    
                                    <td>
                                        <div class="img-container">
                                            <img src="{{ asset("/storage/qrcode/$request->collection_QRCode") }}" rel="nofollow" alt="..." >
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

  @else
  <br>
  <br>
  <br>

    <div class="col-md-8">
        <div class="alert alert-info">No requests yet comeback soon :)</div>
    </div>

    <br>
  <br>
  <br>
  <br>
  <br>
  <br><br>
  <br>
  <br><br>
  <br>
  <br><br>
  <br>
  <br>
  @endif
    
@endsection
  
