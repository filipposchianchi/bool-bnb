@extends('layouts.app')
@section('content')
<div class="container-fluid " >
    <div class="row justify-content-center align-items-center hero"  style="min-height:80vh">
        <div class=" col-md-8 text-center">
            <div class="text-center mt-4 border rounded bg-success p-2">
                <h1 class="text-white">
                    <i class="far fa-check-circle text-white"></i> Transazione avvenuta con successo
                </h1>
            </div>
            
            <div class="text-center border rounded bg-light p-2">
                <h3>L'appartamento <b>{{$apartment -> title}}</b> è stato sponsorizzato e sarà visibile nella vetrina home per
                    @if ($apartment -> sponsored == 1)
                    24 ore
                    @elseif($apartment -> sponsored == 2)
                    72 ore
                    @elseif($apartment -> sponsored == 3)
                    144 ore
                    @endif
                </h3>
            </div>
            <a class="btn btn-light mt-3" href="{{route("home")}}" role="button">Torna alla home</a>
        </div>
        
    </div>
</div>
@endsection