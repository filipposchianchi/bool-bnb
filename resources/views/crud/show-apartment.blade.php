@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card mb-3 col-9">
            <img class="card-img-top" src="{{$apartment -> img}}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$apartment -> title}}</h5>
              <p class="card-text"><strong>address</strong> {{$apartment -> address}}</p>
              <p class="card-text"><strong>descrizione</strong> {{$apartment -> description}}</p>
              <p class="card-text"><strong>roomNum</strong> {{$apartment -> roomNum}}/p>
              <p class="card-text"><strong>bedNum</strong> {{$apartment -> bedNum}}</p>
              <p class="card-text"><strong>mQ</strong> {{$apartment -> mQ}}</p>
              <p class="card-text"><strong>wcNum</strong> {{$apartment -> wcNum}}</p>
              <p class="card-text"><strong>view</strong> {{$apartment -> view}}</p>
              <p class="card-text"><small class="text-muted">{{$apartment -> created_at}}</small></p>
            </div>
        </div>
        <div class="col-3">
            @foreach ($apartment->services as $service)
                {{$service -> name}} <br>
            @endforeach
        </div>
    </div>
</div>
@endsection

