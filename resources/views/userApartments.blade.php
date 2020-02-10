@extends('layouts.app')
@section('content')

    @include('comps.apartment')
    @include('comps.apartments')

    <div class="row">
        <div class="container">
            <h4>Vuoi inserire un nuovo apartamento? </h4>
        </div>
    </div>

    <div id="apartments">
        <apartments
        :apartments='{{$apartments}}'
        ></apartments>
    </div>
@endsection