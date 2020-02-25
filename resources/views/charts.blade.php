@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-xs-12 col-md-6">    
            <p>Numero visualizzazioni appartamento: {{$apartment->view}}</p>
            <canvas id="myChart"></canvas>
        </div> 
        <div class="col-xs-12 col-md-6">    
            <p>Numero messaggi ricevuti: {{$apartment -> messages ->count()}}</p>
        </div>        
    </div>
</div>
<script>
    
</script>
@endsection