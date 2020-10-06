@extends('layouts.dashboard_sidebar_and_navbar')

    
@section('content')
    <div class="navbar-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
    </div>

    <div class="container-fluid">
      @can('isIndependentCollector')
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Collection Details</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                      <tbody>
                            <tr>
                              <td>requested by :{{ $requested_by->name }} {{ $requested_by->surname }}</td>
                              <td>Material :{{ $request->material_type }}</td>
                              <td>Material :R{{ $request->collection_value }}</td>
                              <td>Date :{{ $collection->created_at }}</td>
                            </tr>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">List available Buy Back Centers</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                        @if ($collection->collection_status == "in progress")
                            <tbody>
                              @if (count($buy_back_centers)>0)
                                @foreach ($buy_back_centers as $buy_back_center)
                                  <tr>
                                    <td>center name :{{ $buy_back_center->site_name }}</td>
                                    <td>center address :{{ $buy_back_center->site_address }} (<span class="text text-success">open</span>)</td>
                                    <td>
                                      <form action="{{ route('sell_collection') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="collection_id" id="collection_id" value="{{ $collection->id }}">
                                        <input type="hidden" name="request_id" id="request_id" value="{{ $request->id }}">
                                        
                                        @if ($collection->collection_status == "in progress")
                                            <button type="submit" class="btn btn-primary-xm">CONFIRM COLLECTION HAS BEEN DELIVERED TO {{ $buy_back_center->site_name }}</button>
                                        @endif
                                      </form>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                  No buy back centers available yet.
                              @endif
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                  <td>The above collection has been delivered!</td>
                                </tr>
                            </tbody>
                        @endif
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endcan

      @can('isBuyBackCenter')
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header card-header-tabs card-header-success">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Collection Details</span>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="profile">
                    <table class="table">
                        <tbody>
                              <tr>
                                <td>requested by :{{ $requested_by->name }} {{ $requested_by->surname }}</td>
                                <td>Material :{{ $request->material_type }}</td>
                                <td>Material Price :R{{ $request->collection_value + (10 * $request->collection_value /100) }}</td>
                                <td>Date :{{ $collection->created_at }}</td>
                              </tr>
                              <tr>
                                <td>
                                  @if ($collection->payment_status == null && $collection->collection_status != "purchased") 
                                    <form action="{{ route('payment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="collection_id" id="collection_id" value="{{ $collection->id }}">
                                        <input type="hidden" name="material_price" id="material_price" value="{{$request->collection_value + (10 * $request->collection_value /100) }}">
                                        <button type="submit">Make Payment to Clean App</button>
                                    </form>
                                  @else
                                    <form action="{{ route('create_invoice') }}" method="POST">
                                      @csrf
                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                        <input type="hidden" name="requested_by_name" id="requested_by_name" value="{{ $requested_by->name }}">
                                        <input type="hidden" name="requested_by_email" id="requested_by_email" value="{{ $requested_by->email }}">
                                        <input type="hidden" name="requested_by_surname" id="requested_by_surname" value="{{ $requested_by->surname }}">
                                        
                                        <br>
                                        <br>
                                        <br>
                                        <p>Payment has been made; now you can generate invoice</p>
                                        <button type="submit">Generate Invoice</button>
                                    </form>
                                  @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          
          </div>
        
        </div>
      @endcan
    </div>
  
@endsection