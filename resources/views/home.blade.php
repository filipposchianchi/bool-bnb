@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Apartments:</h1>
    <div class="row">
        @foreach ($apartments as $apartment)
        {{-- <div class="apartment p-3 col-6">
            <a href="{{route('apartmentShow', $apartment -> id)}}">
                <h3>
                    {{$apartment -> title}}
                </h3>
                <ul>
                    <li><strong>address</strong> {{$apartment -> address}}</li>
                    <li><strong>description</strong> {{$apartment -> description}}</li>
                    <li>
                        <img class="apartmentImg" src="{{$apartment -> img}}" alt="">
                    </li>
                </ul>
            </a>
        </div> --}}
        <div class="card mb-3 col-6 apartment">
            <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                <img src="{{$apartment -> img}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$apartment -> title}}</h5>
                    <p class="card-text"><strong>Indirizzo : </strong>{{$apartment -> address}}</p>
                    <p class="card-text">{{$apartment -> description}}</p>
                    <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                </div>
            </a>
          </div>
        @endforeach
    </div>




    {{-- @include('comps.apartment')
    @include('comps.apartments')

    <div id="apartments">
        <apartments
        :apartments='{{$apartments}}'
        ></apartments>
    </div> --}}
</div>
@endsection
