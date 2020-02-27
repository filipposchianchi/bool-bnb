@extends('layouts.app')
@section('content')

    <div class="container-fluid mt-2">
        {{-- DIV MESSAGES --}}
        @if (count($apartments) == 0)
            <div class="container-fluid my-5  welcomeUser">
                <div class="row justify-content-center align-items-center" style="height: 80vh">
                    <div class="col-md-6 text-center p-4" style="background: white; border-radius: 0.6rem">
                        <h1>
                            Benvenuto 
                                @if (!Auth::user()->name ==null )
                                {{ Auth::user()->name }} <span class="caret"></span>
                                @else
                                {{ Auth::user()->email }} <span class="caret"></span>
                                @endif
                        </h1>
                        <p>
                            Per adesso non hai nessun appartamento, vuoi inserirne uno?
                        </p>
                        <a class="btn btn-primary" href="{{route("apartment.create")}}" role="button">Inserisci un appartamento</a>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row p-3 justify-items-center" >
                    <div class="col text-center">
                        <h2>Inbox</h2>
                    </div>
                    <div class="col-12 messages mt-4">
                        <p id="msgCounter"></p>
                        @foreach ($apartments as $apartment)
                            @if (!$apartment -> messages ->count() == 0)
                                <p class="text-center mb-3">Nome Appartamento:<b> {{$apartment->title}}</b></p>
                                @foreach ($apartment -> messages as $message)
                                <div class="apartmentMsg row p-3 align-items-center">
                                    <div class="col-4">
                                        {{-- <strong><strong>{{$apartment->title}} {{$apartment->id}} </strong></strong> --}}
                                        <a href="{{route('apartmentShow', $apartment -> id)}}" class="w-100">
                                            <img src="{{asset('images/'.$apartment -> image)}}" alt="aparment logo" style="width:100%">
                                        </a>
                                    </div>
                                    <div class="col-8 ">
                                        <p>Da: {{$message->email}} </p>
                                        <p>Titolo: {{$message->title}} [{{$message->id}}] </p>
                                        <p>Messaggio: {{$message->body}} </p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <script>
                                var apartmentsMsgCheck = false; 
                            </script>
                            @endif
                        
                        @endforeach
                    </div>
                </div>
    
                <div class="row justify-content-around align-items-around my-3">
                    <div class="col-xs-12 text-center">
                        <h2>Appartamenti:</h2>
                    </div>
                    <div class="col-xs-12 text-center">
                        <a class="btn btn-success" href="{{route("apartment.create")}}" role="button">Inserisci un nuovo appartamento</a>
                    </div>
                </div>
                @foreach ($apartments as $apartment)
                    <div class="row align-items-center">
                        <div class="card mb-3 col-md-9 apartment">
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
                        <div class="col-md-3">
                            <div class="col-12 d-flex justify-items-around align-items-center">
                                <a class="col btn btn-primary mb-3 " href="{{route("apartment.edit" , $apartment -> id)}}" role="button" title="modifica annuncio"><i class="fas fa-edit"></i></a>
                                <a class=" col btn btn-danger mb-3 mx-2" href="{{route("apartment.delete" , $apartment -> id)}}" role="button" title="elimina annuncio"><i class="fas fa-trash"></i></a>
                                <a class=" col btn btn-warning mb-3" href="{{route("apartment.sponsor" , $apartment -> id)}}" role="button" title="sponsorizza annuncio"><i class="fas fa-star"></i></a>
                            </div>
                            {{-- <a class="btn btn-secondary mb-3" href="{{route("apartment.charts" , $apartment -> id)}}" role="button">statistiche annuncio</a> --}}
                            {{-- <a class="btn btn-success" href="{{route("apartment.test" , $apartment -> id)}}" role="button">test annuncio</a> --}}
                            @if ($apartment -> sponsored > 0)
                                <p class="green">Questo annuncio è sponsorizzato</p>
                            @else
                                <p class="red">Questo annuncio non è sponsorizzato</p>
                            @endif
                            {{-- SE L'APPARTAMENTO E' SPONSORIZZATO --}}
                            @if ($apartment -> visible == 0)
                                <p class="green">Questo annuncio è nascosto</p>
                            @else
                                <p class="red">Questo annuncio è pubblico</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
        @endif
        
            
        
    </div>
    <script>
        if (!apartmentsMsgCheck) {
            $('#msgCounter').html('Non hai ancora ricevuto messaggi');
        }
    </script>
@endsection