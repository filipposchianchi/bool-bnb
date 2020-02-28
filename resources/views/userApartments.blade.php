@extends('layouts.app')
@section('content')

    <div class="container-fluid mt-2">
        {{-- DIV MESSAGES --}}
        @if (count($apartments) == 0)
            <div class="container-fluid  welcomeUser">
                <div class="row justify-content-center align-items-center" style="height: 80vh">
                    <div class="col-md-5 text-center p-5" style="background: white; border-radius: 0.6rem">
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
                <div class="row justify-content-center p-5 text-center">
                    <div class="col-md-6">
                        <h1>
                            Lista appartamenti
                        </h1>
                    </div>
                    <div class="col-md-5">
                        <a class="btn btn-success" href="{{route("apartment.create")}}">Inserisci un nuovo&nbspappartamento</a>
                    </div>
                </div>
                
                
            </div>
            @foreach ($apartments as $apartment)
            <div class="row justify-content-center p-2 mb-2">
                <div class="col-11 d-flex  justify-content-center">
                    <div class="card mb-3 col-md-6 apartment">
                        <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$apartment -> title}}</h5>
                                <p class="card-text">{{$apartment -> address}}</p>
                                <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 d-flex flex-column justify-content-around p-3">
                        <div class="modifica">
                            <h2 class>Operazione appartamento</h2>
                            <div class="d-flex justify-items-around align-items-center">
                                <a class="col btn btn-primary mb-3 " href="{{route("apartment.edit" , $apartment -> id)}}" role="button" title="modifica annuncio"><i class="fas fa-edit"></i></a>
                                <a class=" col btn btn-danger mb-3 mx-2" href="{{route("apartment.delete" , $apartment -> id)}}" role="button" title="elimina annuncio"><i class="fas fa-trash"></i></a>
                                <a class=" col btn btn-warning mb-3" href="{{route("apartment.sponsor" , $apartment -> id)}}" role="button" title="sponsorizza annuncio"><i class="fas fa-star"></i></a>
                            </div>
                        </div>
                        <div class="statusAppartamento">
                            <h2>Status appartamento</h2>
                            @if ($apartment -> sponsored > 0)
                            <p class="green">Questo annuncio è sponsorizzato</p>
                            @else
                                <p class="red">Questo annuncio non è sponsorizzato</p>
                            @endif
                            @if ($apartment -> visible == 0)
                                <p class="green">Questo annuncio è nascosto</p>
                            @else
                                <p class="red">Questo annuncio è pubblico</p>
                            @endif
                        </div>
                        <div class="div">
                            <h2>Messaggi</h2>
                            <div class="messages">
                                @if (!$apartment -> messages ->count() == 0)
                                    @foreach ($apartment-> messages as $message)
                                        <div class="col border">
                                            <p>Da: {{$message->email}} </p>
                                            <p>Titolo: {{$message->title}} [{{$message->id}}] </p>
                                            <p>Messaggio: {{$message->body}} </p>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Questo appartamento non ha messaggi</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
            @endforeach
            
        @endif
        
            
        
    </div>
    <script>
        if (!apartmentsMsgCheck) {
            $('#msgCounter').html('Non hai ancora ricevuto messaggi');
        }
    </script>
@endsection