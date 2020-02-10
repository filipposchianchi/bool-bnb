@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>Apartments:</h1>
    @foreach ($apartments as $apartment)
    <h3>
        {{$apartment -> title}}
    </h3>
    <ul>
        <li><strong>address</strong> {{$apartment -> address}}</li>
        <li><strong>description</strong> {{$apartment -> description}}</li>
        <li><strong>img</strong> {{$apartment -> img}}</li>
        <li><strong>roomNum</strong> {{$apartment -> roomNum}}</li>
        <li><strong>bedNum</strong> {{$apartment -> bedNum}}</li>
        <li><strong>mQ</strong> {{$apartment -> mQ}}</li>
        <li><strong>wcNum</strong> {{$apartment -> wcNum}}</li>
        <li><strong>view</strong> {{$apartment -> view}}</li>
    </ul>
    @endforeach --}}


    @include('comps.apartments')

    <div id="app">
        @foreach ($apartments as $apartment)
            <post-apartment>
            </post-apartment>
        @endforeach
    </div>
</div>
@endsection
