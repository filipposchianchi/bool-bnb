@extends('layouts.app')
@section('content')

    <div class="container mt-2">
        {{-- DIV MESSAGES --}}
        
        <div class="row py-5" >
            <h2>Inbox</h2>
            <div class="col-12 messages mt-4">
                @foreach ($apartments as $apartment)
                @if (!$apartment -> messages ->count() == 0)
                    <p class="text-center mb-3">Nome Appartamento:<b> {{$apartment->title}}</b></p>
                    @foreach ($apartment -> messages as $message)
                    <div class="apartmentMsg row p-3">
                        <div class="col-3">
                            {{-- <strong><strong>{{$apartment->title}} {{$apartment->id}} </strong></strong> --}}
                            <a href="{{route('apartmentShow', $apartment -> id)}}"">
                                <img src="{{asset('images/'.$apartment -> image)}}" alt="aparment logo" style="width:100%">
                            </a>
                        </div>
                        <div class="col-8 offset-1">
                            <p>Da: {{$message->email}} </p>
                            <p>Titolo: {{$message->title}} [{{$message->id}}] </p>
                            <p>Messaggio: {{$message->body}} </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- <p>0 messaggi</p> --}}
                @endif
                @endforeach
            </div>
        </div>





        <div class="row column justify-content-between align-items-around mb-5">
            <h2>Appartamenti:</h2>
            <a class="btn btn-success" href="{{route("apartment.create")}}" role="button">Inserisci un nuovo appartamento</a>
        </div>
        @foreach ($apartments as $apartment)
            <div class="row">
                <div class="card mb-3 col-9 apartment">
                    <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                        <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$apartment -> title}}</h5>
                            <p class="card-text">{{$apartment -> address}}</p>
                            <p class="card-text">{{$apartment -> description}}</p>
                            <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                        </div>
                    </a>
                </div>
                <div class="col-3 mt-5">
                    <a class="btn btn-warning mb-3" href="{{route("apartment.edit" , $apartment -> id)}}" role="button">modifica annuncio</a>
                    <a class="btn btn-danger mb-3" href="{{route("apartment.delete" , $apartment -> id)}}" role="button">cancella annuncio</a>
                    {{-- <a class="btn btn-secondary mb-3" href="{{route("apartment.charts" , $apartment -> id)}}" role="button">statistiche annuncio</a> --}}

                    {{-- <a class="btn btn-success" href="{{route("apartment.test" , $apartment -> id)}}" role="button">test annuncio</a> --}}

                    @if ($apartment -> visible == 0)
                        <p class="green">Questo annuncio è nascosto</p>
                    @else
                        <p class="red">Questo annuncio è pubblico</p>
                    @endif
                </div>
        </div>
        @endforeach
            
        
    </div>
@endsection