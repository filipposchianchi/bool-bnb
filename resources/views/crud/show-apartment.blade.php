@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <h1>Apartments:</h1>
        @foreach ($apartments as $apartment)
        <div class="apartment p-3 col-6">
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
                    <li><strong>roomNum</strong> {{$apartment -> roomNum}}</li>
                    <li><strong>bedNum</strong> {{$apartment -> bedNum}}</li>
                    <li><strong>mQ</strong> {{$apartment -> mQ}}</li>
                    <li><strong>wcNum</strong> {{$apartment -> wcNum}}</li>
                    <li><strong>view</strong> {{$apartment -> view}}</li>
                </ul>
            </a>

        </div>
        @endforeach
    </div>
</div>
@endsection
