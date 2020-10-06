@extends('layouts.app2')


@section('content')

{{-- d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm --}}

@include('inc.backend_navbar')

<div class="container">
    <div class="row justify-content-center">
        @include('inc.backend_menu')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h1>Create Notice</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('notices.store')}}" enctype="multipart/form-data" class="p-5 bg-light">
                   
                        @csrf
                        <div class="form-group">
                            <label for="notice_title">Notice Title</label>
                        <input type="text" name="notice_title" id="notice_title" class="form-control @error('notice_title') is-invalid @enderror" value="{{old('notice_title')}}" placeholder="Example: Notice Title">
                            
                            @error('notice_title')
                                <span class="help text-danger" role="alert">
                                    {{$errors->first('notice_title')}}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="notice_body">Description</label>
                            <textarea name="notice_body" id="notice_body" class="form-control @error('notice_body') is-invalid @enderror" cols="30" rows="4" placeholder="Notice Body">{{old('notice_body')}}</textarea>
                            
                            @error('notice_body')
                                <span class="help text-danger" role="alert">
                                    {{$errors->first('notice_body')}}
                                </span>
                            @enderror
                        
                        </div>
    
                        <div class="form-group">
                            <button class="btn btn-primary rounded-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


