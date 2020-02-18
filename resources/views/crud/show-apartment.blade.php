@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-9">
            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
            <div class="card-body row">
                <div class="col-8">
                    <h5 class="card-title"><strong>Nome appartamento:</strong> {{$apartment -> title}}</h5>
                    <p class="card-text"><strong>Indirizzo:</strong> {{$apartment -> address}}</p>
                    <p class="card-text"><strong>Descrizione</strong> {{$apartment -> description}}</p>
                    <p class="card-text"><strong>Numero di stanze</strong> {{$apartment -> roomNum}}</p>
                    <p class="card-text"><strong>Posti letto</strong> {{$apartment -> bedNum}}</p>
                    <p class="card-text"><strong>Mq</strong> {{$apartment -> mQ}}</p>
                    <p class="card-text"><strong>Numero di bagni</strong> {{$apartment -> wcNum}}</p>
                    {{-- <p class="card-text"><strong>view</strong> {{$apartment -> view}}</p> --}}
                    <p class="card-text"><small class="text-muted">{{$apartment -> created_at}}</small></p>
                </div>
                <div class="col-3 offset-1">
                    @if (!$apartment->services->count() == 0)
                        <h5 class="card-title"><strong>Servizi</strong></h5>
                        @foreach ($apartment->services as $service)
                            <p class="card-text">{{$service -> name}} </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        

    </div>
    <div class="row jutify-items-center h-50">
        <div class="col-6">
            

            <form action="{{route('message.store', $apartment -> id)}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email">Email:</label> 

                    @auth
                    <br>
                    <input class="form-control" type="email" name="email" value="{{ Auth::user() -> email }}">
                    @else
                    <br>
                    <input class="form-control" type="email" name="email" value="">
                    @endauth
                    
                    <br>
                    <label for="titolomsg">Titolo messaggio:</label> 
                    <input class="form-control" type="text" name="title" value="">
                    <br>
                    <label for="messaggio">Messaggio:</label> 
                    <input class="form-control" type="text" name="body" value="">
                    <br>
                    <button type="submit">INVIO MESSAGGIO</button>
                    

                    @if(Session::has('msg'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('msg') }}
                    </p>
                    @endif

                </div> 
            </form>

        </div>
        <div class="col-6">
            <div id='map' class='map'></div>
        </div>
    </div>
</div>


@endsection
