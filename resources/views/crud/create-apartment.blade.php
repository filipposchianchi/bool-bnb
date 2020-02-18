@extends('layouts.app')
@section('content')

<div class="container">
  <form action="{{route('apartment.store')}}" method="post" enctype='multipart/form-data'  >
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Nome Appartamento:</label>
      <input class="form-control" type="text" name="title" value="" placeholder="Inserisci nome appartamento">
    </div>
<<<<<<< HEAD

    {{-- ADDRESS --}}
    {{-- <div class="form-group">
      <label for="address">address:</label>
      <input class="" type="text" name="streetName" value="" placeholder="streetName">
      <input class="" type="number" name="streetNumber" value="" placeholder="streetNumber">
      <input class="" type="text" name="municipality" value="" placeholder="municipality">
      <input class="" type="text" name="postalCode" value="" placeholder="postalCode">
      <input class="" type="text" name="countryCode" value="" placeholder="countryCode" >
    </div>  --}}
    <div class="form-group">
      <label for="address">address:</label>
=======
    <div class="form-group">
      <label for="address">Indirizzo:</label>
>>>>>>> master
      <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Inserisci l'indirizzo" autocomplete="off" required/>
      <div id="addressList">
      </div>
      <div>
        {{ csrf_field() }}
      </div>
     </div>

    <div class="form-group position">
        <input type="text" name="latitude" id="latitude"/>
        <input type="text" name="longitude" id="longitude"/> 
    </div>
    <div class="form-group">
      <label for="description">Descrizione:</label>
      <textarea  class="form-control" type="text" name="description" value="" placeholder="Inserisci descrizione"></textarea>
    </div>
    <div class="form-group">
      <label for="image">img:</label>
      {{-- <input class="form-control" type="text" name="img" value=""> --}}
      <input id="image" class="form-control" type="file" name="image" value="" required>
    </div>
    <div class="row">

      <div class="form-group col-3">
        <label for="roomNum">Numero stanze:</label>
        <input class="form-control" type="number" name="roomNum" value="1" min="0" max="20">
      </div>
      <div class="form-group col-3">
        <label for="bedNum">Numero letti:</label>
        <input class="form-control" type="number" name="bedNum" value="1" min="0" max="20">
      </div>
      <div class="form-group col-3">
        <label for="mQ">Metri quadrati:</label>
        <input class="form-control" type="number" name="mQ" value="1" min="0">
      </div>
      <div class="form-group col-3">
        <label for="wcNum">Bagni:</label>
        <input class="form-control" type="number" name="wcNum" value="1" min="0" max="20">
      </div>
    </div>
    <div class="form-group col-8">
      <label for="services">Servizi:</label> <br>
      @foreach ($services as $service)
      <input name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
      @endforeach
    </div> 
    <button type="submit">SALVA</button>
  </form>
</div>
        
@endsection