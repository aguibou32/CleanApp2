@if ( count($requests)>0)
<div class="page-content">
    <div class="contact-page f1">
        <div class="contact-top">
            <div class="container">
                @foreach ($requests as $request)
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">

                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img style="width:70px;" class="media-object img-fluid" src="{{ asset('storage/profile pictures/new_logo.png')}}"  alt="Image" > 
                                    </a>
                                    <div class="media-body"></p>
                                        <h4 class="media-heading">
                                            <p>{{ $request->request->resident->user->name }} {{  $request->request->resident->user->surname }} 

                                            @if ( $request->collection_status == "purchased")
                                                <span class="badge badge-primay">delivered</span></p>
                                            @endif
                                                
                                        </h4>
                                        <p> Location:{{ $request->request->address }}</p>
                                        <p>Phone: {{ $request->request->resident->user->phone_no }}</p>
                                        <p>Recyclable type: {{ $request->material_type }}</p>
                                        @can('isIndependentCollector')
                                            @if (Auth::user()->active == "active")
                                            <form method="POST" action="{{ route('collections.store') }}">
                                                @csrf
                                                <input type="hidden" name="collection_status" value="in progress">
                                                <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                <input type="hidden" name="collector_id" value="{{ Auth::user()->profile_id}}">
                                                
                                                @if ($request->collection_status == 'requested')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        navigate to this place
                                                    </button>
                                                @endif

                                                @if ($request->collection_status == 'in progress')
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" disabled>
                                                        navigate to this place
                                                    </button>
                                                @endif

                                                @if ($request->collection_status == 'requested')
                                                    <button type="submit" class="btn btn-primary">Mark Request as collected</button>
                                                @endif

                                                @if ($request->collection_status == 'in progress')
                                                    <button type="submit" class="btn btn-warning" disabled>Mark Request as collected</button>
                                                @endif


                                            </form>
                                            @endif
                                             <br>
                                            <p class="">This request for collection was post on: {{ $request->created_at }}</p>
                                        @endcan
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-3">
                                <iframe  ></iframe>
                            </div>
                        </div>
                        
                   @endforeach
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@else
<br>
<br>
<br>
<br>
<div class="col-md-2">
</div>

<div class="col-md-8">
    <div class="alert alert-info">No requests yet comeback soon :)</div>
</div>

<div class="col-md-2">

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@endif