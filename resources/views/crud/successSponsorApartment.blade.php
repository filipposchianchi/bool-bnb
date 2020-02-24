@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-item-center">
            <div class="col-8">

                <h1>TRANSAZIONE AVVENUTA CON SUCCESSO</h1>
            </div>
            <div class="col-8">

                <a class="btn btn-warning mb-3" href="{{route("user")}}" role="button">Torna nella homa</a>
            </div>
        </div>
    </div>
@endsection