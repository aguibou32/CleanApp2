@extends('layouts.dashboard_sidebar_and_navbar')

@section('content')

<br>
<br>

<div class="navbar-wrapper">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Informal Collectors</li>
    </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
      
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-success">
            <h4 class="card-title mt-0"> Users</h4>
            <p class="card-category"> Here is the list of all the informal collectors</p>
            
          </div>
          <div class="card-body">
            <div class="modal fade" id="add_informal_collector" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>                     
                        <th scope="col">Surname</th>
                        <th scope="col">number of collected items</th>
                        <th>Value</th>
                        <th>Reward</th>
                      </tr>
                    </thead>
  
                   
                    <tbody>
                        @if (count($invoices)>0)
                            @foreach ($invoices as $invoice)
                                <tr>
                                  <td scope="col">
                                    <p>{{ $invoice->name }}</p>
                                  </td>
                                  <td scope="col">
                                    <p>{{ $invoice->surname }}</p>
                                  </td>
                                  <td scope="col">
                                    <p>{{ $invoice->number_of_collection_material}}</p>
                                  </td>
                                  <td scope="col">
                                    <p class="text text-primary">R{{ $invoice->value }}</p>
                                  </td>

                                  <td scope="col">
                                    @if ($invoice->number_of_collection_material<500 || $invoice->value<2000)
                                        <p>No rewarding yet</p>
                                    @endif
                                    @if ($invoice->number_of_collection_material>500 || $invoice->value>2000)
                                        <p>Recycling bin with wheels</p>
                                    @endif
                                    @if ($invoice->number_of_collection_material>1000 || $invoice->value>5000)
                                        <p>2 recycling bins with wheels</p>
                                    @endif
                                  </td>


                                </tr>
                            @endforeach
                        @else
                            <tr>
                              <td>
                              <h4 class="text text-center text-info">No informal collections activity yet</h4>
                              </td>
                            </tr>
                        @endif
                    </tbody>
                   
                    
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection