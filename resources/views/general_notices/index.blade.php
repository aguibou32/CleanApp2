@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row">
        @include('inc.backend_menu')
        <div class="col-md-9">
            <h3>General Notices</h3>
               @if (count($notices)>0)
                    @foreach ($notices as $notice)
                    <div class="card">
                        <div class="card-header">
                            <span class="badge badge-secondary">{{$notice->created_at}}</span>
                            <div class="panel-status pull-right">
                                <span class=""><span class="fa fa-check text-info" style="color:add the color here;"></span> </span>
                            </div>
                                <h4>{{ $notice->notice_title }}</h4>
                        </div>
                        <div class="card-body">
                            <p>{!! $notice->notice_body !!}</p>
                            <br>
                            <br>
                            
                            @can('isAdmin')
                                <small class="font-italic"><a href="{{ route('general_notice.edit', $notice->id) }}">edit this notice</a></small>
                                <form method="POST" action="{{ route('general_notice.destroy', $notice->id) }}" class="">
                                                                                                    
                                    @csrf
                                    @method('DELETE')
                                    <button class="fa fa-trash text-danger pull-right" onclick="return confirm('Do you want to remove this notice ?')"></button>
                                </form>
                            @endcan
                        </div>
                        

                    </div>
                    <br>
                @endforeach
               @else
                   <div class="alert alert-info">No notices yet</div>
               @endif
        </div>
        
    </div>
</div>
@endsection
<br>

