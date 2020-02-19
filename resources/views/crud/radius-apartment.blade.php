@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row flex-nowrap apartments">
            @foreach ($apartments as $apartment)
                <div class="col-sm-12 col-md-4 apartment">
                    <div class="box mx-3 card mb-3 ">
                        <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." style="height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$apartment -> title}}</h5>
                                <p class="card-text">{{$apartment -> address}}</p>
                                <p class="card-text">{{$apartment -> description}}</p>
                                <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection