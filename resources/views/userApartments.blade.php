@extends('layouts.app')
@section('content')

    @include('comps.apartment')
    @include('comps.apartments')

    <div id="apartments">
        <apartments
        :apartments='{{$apartments}}'
        ></apartments>
    </div>
@endsection