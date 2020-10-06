@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row">
        @include('inc.backend_menu')
        <div class="col-md-6">
            <h3>Notices: Computer Sciences</h3>
                @foreach ($notices as $notice)
                    <div class="card">
                        <div class="card-header">
                            <span class="badge badge-secondary">{{$notice->created_at}}</span>
                                {{$notice->notice_title}}
                            <div class="panel-status pull-right">
                                <span class=""><span class="fa fa-check text-info" style="color:add the color here;"></span> </span>
                            </div>
                        </div>
                        <div class="card-body">
                            {{$notice->notice_body}}
                        </div>
                    </div>
                    <br>
                @endforeach
        </div>
        <div class="col-md-3 small fixed">
            <div class="card">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Computer Sc</li>
                  <li class="list-group-item">Informatics</li>
                </ul>
              </div>
        </div>
    </div>
</div>
@endsection
<br>

