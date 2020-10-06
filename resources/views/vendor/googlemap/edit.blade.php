@extends('layouts.app')

@section('content')
    <div class="container">
        <x-map-location-edit :location="$location"></x-map-location-edit>
    </div>
@endsection



