@extends('layouts.dashboard_sidebar_and_navbar')

    
@section('content')


<style>

#map{
    height:400px;
    width:100%; 
}

  /**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
box-sizing: border-box;

height: 40px;

padding: 10px 12px;

border: 1px solid transparent;
border-radius: 4px;
background-color: white;

box-shadow: 0 1px 3px 0 #e6ebf1;
-webkit-transition: box-shadow 150ms ease;
transition: box-shadow 150ms ease;
}

.StripeElement--focus {
box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
border-color: #fa755a;
}

.StripeElement--webkit-autofill {
background-color: #fefde5 !important;}
</style>
    <div class="navbar-wrapper">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item" data-color="green"><a href="{{ route('welcome') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
    </div>

    <div class="container-fluid">

      @can('isAdmin')
          
         <div class="row">
            <div class="col-md-4">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">cleaning_services</i>
                  </div>
                  <p class="card-category font-weight-bold text-dark">Total Amount Made By CleanApp</p>
                  <h2 class="card-title">
                    <strong>R{{ $amount_cleanapp }}</strong>
                  </h2>
                </div>
                
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">local_shipping</i>
                  </div>
                  <p class="card-category font-weight-bold text-dark">Amount Made By All Collectors</p>
                  <h2 class="card-title"> <strong>R{{ $amount_collectors }} </strong> </h2>
                </div>
                
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">face</i>
                  </div>
                  <p class="card-category font-weight-bold text-dark">Total Amount Made By All Residents</p>
                  <h2 class="card-title"> <strong>R{{ $amount_residents }} </strong>  </h2>
                </div>
              </div>
            </div>
          </div>

         <div class="row">

           <div class="col-md-4">
             {!! $chart00->container() !!}
             <script src="{{ $chart00->cdn() }}"></script>
             {{ $chart00->script() }}
           </div>
           
            <div class="col-md-8">
              {!! $chart0->container() !!}
              <script src="{{ $chart0->cdn() }}"></script>
              {{ $chart0->script() }}
            </div>

         </div>

          <div class="row">
            <div class="col-md-6">
              {!! $chart->container() !!}
              <script src="{{ $chart->cdn() }}"></script>
              {{ $chart->script() }}
            </div>

            <div class="col-md-6">
              {!! $chart2->container() !!}
              <script src="{{ $chart2->cdn() }}"></script>
              {{ $chart2->script() }}
            </div>
           </div>

           <br>
           <br>

          <div class="row">
            <div class="col-md-12">
              {!! $chart3->container() !!}
              <script src="{{ $chart3->cdn() }}"></script>
              {{ $chart3->script() }}
            </div>
           </div>

           <div class="row">
            <div class="col-md-12">
              {!! $chart4->container() !!}
              <script src="{{ $chart4->cdn() }}"></script>
              {{ $chart4->script() }}
            </div>
           </div>
          
      @endcan
      

      @can('isResident')
          <br>
          <br>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-success">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Request History</span>
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
                                  @if (Auth::user()->id == $request->request->resident->user->id)
                                    <tr>
                                      <td>Date:{{ $request->created_at }}</td>
                                      <td>Material Type:{{ $request->material_type }}</td>
                                      <td>Quantity:{{ $request->material_quantity }}</td>
                                      <td>Total amount: R{{ $request->collection_value }}</td>
                                      <td class="td-actions text-right"> status:
                                        <button type="button" rel="tooltip" title="Request status" class="btn btn-primary btn-link btn-sm">
                                          {{ $request->collection_status }}
                                        </button>
                                      </td>
                                      <td><a rel="stylesheet" href={{ asset("/storage/qrcode/$request->collection_QRCode") }}> qrcode </a></td>
                                    </tr>
                                  @endif
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
      @endcan

      @can('isIndependentCollector')
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">List of collections</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                      <tbody>
                        @if (count($collections)>0)
                          @foreach ($collections as $collection)
                             @if (Auth::user()->profile_id == $collection->collector_id)
                              <tr>
                                <td>Id: {{ $collection->id }}</td>
                                <td>Date :{{ $collection->created_at }}</td>
                                <td>Status: @if ($collection->collection_status == "purchased")
                                  <span class="badge badge-primary">{{$collection->collection_status}}</span>
                                @else
                                  <span class="badge badge-info">{{ $collection->collection_status }}</span>
                                @endif</td>
                                <td> <a href="{{ route('collections.show', $collection->id) }}">view this in details</a></td>
                                </td>
                              </tr>
                             @endif
                              
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


      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Ratings</span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                      <tbody>
                          
                        @if (count($feedbacks)>0)
                              @foreach ($feedbacks as $feedback)

                                @if (Auth::user()->profile_id == $feedback->collector_id)
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Number stars</th>
                                          <th scope="col">Resident comment</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row"></th>
                                          <td>{{$feedback->rating}}</td>
                                          <td>{{ $feedback->feedback_message}}</td>
                                        </tr>
                                      
                                      </tbody>
                                    </table>
                                @endif
                              @endforeach  
                        @else
                              no ratings yet
                        @endif

                      </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      
      </div>
      @endcan

      @can('isBuyBackCenter')
      <script src="https://js.stripe.com/v3/"></script>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">List of collections</span>
                  <span class="pull-right">
                     <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Create Invoice for Informal Collector
                      </button>
                      <!-- Modal -->
                  </span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                      <tbody>
                        @if (count($collections)>0)
                          @foreach ($collections as $collection)
                              @if ($collection->collection_status != "in progress")
                              <tr>
                                <td>Id: {{ $collection->id }}</td>
                                <td>Date :{{ $collection->created_at }}</td>
                                <td>Status : {{ $collection->collection_status }}</td>
                                <td> <a href="{{ route('collections.show', $collection->id) }}">view this in details</a></td>
                                </td>
                              </tr>
                              @endif
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



      
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Informal Invoicing System</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                      <script src="https://js.stripe.com/v3/"></script>
                      <div class="row">
                          
                          <div class="col-md-12">
                              <form action="{{ route('informal_invoice.store') }}" method="POST" id="payment-form" class="form-group">
                                  @csrf
                                  <div class="form-row">
                                      <label for="card-element">Name</label>
                                      <input type="text" name="name" id="name" class="form-control" required>
                                  </div>
                                  <div class="form-row">
                                      <label for="card-element">Surname</label>
                                      <input type="text" name="surname" id="surname" class="form-control" required>
                                  </div>
                                  <br>
                                  <div class="form-row">
                                      <label for="card-element">Buy back center email</label>
                                      <input type="text" name="email" id="email" value="{{ Auth()->user()->email }}" class="form-control" required>
                                  </div>
                
                                  <div class="form-row">
                                      <label for="card-element">Number of items</label>
                                      <input type="integer" name="number_of_collection_material" id="number_of_collection_material" class="form-control" required>
                                  </div>

                                  <div class="form-row">
                                      <label for="card-element">Amount (in Rands)</label>
                                      <input type="integer" name="amount" id="amount" class="form-control" required>
                                  </div>
                
                                  <div class="form-row">
                                      <label for="card-element">
                                      Credit or debit card
                                      </label>
                                      <div id="card-element" class="form-control">
                                      <!-- A Stripe Element will be inserted here. -->
                                      </div>
                      
                                      <!-- Used to display form errors. -->
                                      <div id="card-errors" role="alert"></div>
                                  </div>
                      
                                  <br>
                                  <button type="submit" class="btn btn-primary">Submit Payment</button>
                              </form>
                          </div>
                      </div>
                  <!-- Credit Card Payment Form - END -->
                  </div>
            </div>
          </div>
        </div>
      </div>
      

      @endcan

      @can('isPickItUpCenter')
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">List of illigal dumpings </span>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Address</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($illigal_dumpings)>0)
                        @foreach ($illigal_dumpings as $dumping)
                          <tr>
                            <th scope="row">{{ $dumping->id }}</th>
                            <td>{{ $dumping->address }}</td>
                            <td><a href='{{ asset("storage/$dumping->dumping_picture")}}' target="_blank">download dumping picture</a></td>
                            <td>
                             <form method="POST" action="{{ route('report_dumping.destroy', $dumping->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" rel="tooltip" onclick="return confirm('are you sure?')" class="btn btn-danger btn-link btn-sm" data-original-title="Remove">
                                  <i class="material-icons">close</i>
                              </button>
                             </form>
                          </td>
                          </tr>
                        @endforeach
                      @else
                          <tr>
                            <td><p class="text text-info">No illigal dumping reported yet !</p> </td>
                          </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div id="map"></div>
          </div>
        </div>
      
      </div>
      @endcan

    </div>

    <script>
      function initMap(){
        // Map options
        var options = {
          zoom:13,
          // 26.2041° S, 28.0473° E
  
          center:{lat:-26.2041,lng:28.0473}
        }
  
        // New map
        var map = new google.maps.Map(document.getElementById('map'), options);
  
        // Listen for click on map
        google.maps.event.addListener(map, 'click', function(event){
          // Add marker
          addMarker({coords:event.latLng});
        });
  
        
        var markers = [
          {
            coords:{lat:-26.2041,lng:28.0979},
            content:'<h3>Illigal dumpimg pick it</h3>'
          },

          {
            coords:{lat:-26.2042,lng:28.0474},
            iconImage: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            content:'<h3>Illigal dumpimg pick it</h3>'
          },

          {
            coords:{lat:-26.1936,lng:28.0496},
            iconImage: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            content:'<h3>Illigal dumpimg pick it</h3>'
          },

          {
            coords:{lat:-26.2049,lng:28.0118},
            iconImage: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            content:'<h3>Illigal dumpimg pick it</h3>'
          },
          {
            coords:{lat:-26.1806,lng:28.0391},
            iconImage: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            content:'<h3>Illigal dumpimg pick it</h3>'
          },

          
        ];
  
        for(var i = 0;i < markers.length;i++){
          addMarker(markers[i]);
        }
  
        function addMarker(props){
          var marker = new google.maps.Marker({
            position:props.coords,
            map:map,
          });
  
          if(props.iconImage){
            marker.setIcon(props.iconImage);
          }
  
        }
      }
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANrsKzpVrZCHD0SAcBN-vNEx7f7ARF_g0&callback=initMap">
      </script>

<style>
  /**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
box-sizing: border-box;

height: 40px;

padding: 10px 12px;

border: 1px solid transparent;
border-radius: 4px;
background-color: white;

box-shadow: 0 1px 3px 0 #e6ebf1;
-webkit-transition: box-shadow 150ms ease;
transition: box-shadow 150ms ease;
}

.StripeElement--focus {
box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
border-color: #fa755a;
}

.StripeElement--webkit-autofill {
background-color: #fefde5 !important;}
</style>
  
  <!-- Credit Card Payment Form - START -->
  


<script>
      // Create a Stripe client.
var stripe = Stripe('pk_test_mdYrq3SvV6nEuN7Or7ZNRikG00ptq1TDto');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
base: {
  color: '#32325d',
  fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
  fontSmoothing: 'antialiased',
  fontSize: '16px',
  '::placeholder': {
    color: '#aab7c4'
  }
},
invalid: {
  color: '#fa755a',
  iconColor: '#fa755a'
}
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
var displayError = document.getElementById('card-errors');
if (event.error) {
  displayError.textContent = event.error.message;
} else {
  displayError.textContent = '';
}
});

// Handle form submission.
var form = document.getElementById('payment-form');



form.addEventListener('submit', function(event) {
event.preventDefault();

var options = {
    name:document.getElementById('name').value,
    surname:document.getElementById('surname').value
}


stripe.createToken(card, options).then(function(result) {
  if (result.error) {
    // Inform the user if there was an error.
    var errorElement = document.getElementById('card-errors');
    errorElement.textContent = result.error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(result.token);
  }
});
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
// Insert the token ID into the form so it gets submitted to the server
var form = document.getElementById('payment-form');
var hiddenInput = document.createElement('input');
hiddenInput.setAttribute('type', 'hidden');
hiddenInput.setAttribute('name', 'stripeToken');
hiddenInput.setAttribute('value', token.id);
form.appendChild(hiddenInput);

// Submit the form
form.submit();
}
</script>
  
@endsection



{{-- The map creation I learned from Traversy Media and the link of the code is: 
  https://www.youtube.com/redirect?q=http%3A%2F%2Fwww.traversymedia.com%2Fdownloads%2Fmymap.zip&redir_token=QUFFLUhqbE5YRHhlZFo0TVBwalZxQlF1aUpSVHZMWjFWQXxBQ3Jtc0trckxnb1V3VGd0NWg1Q2pPdFRmXzg2ZEUwQ0gzZWtQamN3a1VMb2JTRWM3TWhUV09ERzBhTXhnQmFiVUdsNlp6b0VrcDdiTVNKSUtwTUxxWXV1SS1hLUhOQlQ4SWc0WEFkTHBUemdJOFZ1TlJEMTA0Yw%3D%3D&v=Zxf1mnP5zcw&event=video_description --}}