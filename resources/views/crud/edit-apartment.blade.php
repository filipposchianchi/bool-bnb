@extends('layouts.app')
@section('content')

<div class="container">
  <form action="{{route('apartment.update', $apartment -> id)}}" method="post" enctype='multipart/form-data'>
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Nome Appartamento:</label>
      <input class="form-control" type="text" name="title" value="{{$apartment->title}}">
    </div>
    <div class="form-group">
      <label for="address">Indirizzo:</label>
      <input type="text" name="address" id="address" class="form-control input-lg" value="{{$apartment->address}}" autocomplete="off"
      required/>
      <div id="addressList">
      </div>
      </div> 
    <div class="form-group position">
      <input type="text" name="latitude" id="latitude"/>
      <input type="text" name="longitude" id="longitude"/> 
    </div>
    <div class="form-group">
      <label for="description">Descrizione:</label>
      <textarea id="description" class="form-control" type="text" name="description" value="">{{$apartment->description}}</textarea>
    </div>

    <div class="row">
      <div class="col-3">
        <label for="img">Immagine precedente: </label>
        <img class="ml-1" src="{{asset('images/'.$apartment -> image)}}" style="width:5rem;">
      </div>  
      <div class="form-group col-9 ">
        <input class="form-control mt-1" type="file" name="image" src="{{asset('images/'.$apartment -> image)}}">
      </div>
      
  </div>
      
    <div class="row">

      <div class="form-group col-3">
        <label for="roomNum">Numero stanze:</label>
        <input class="form-control" type="number" name="roomNum" value="{{$apartment->roomNum}}" min="0" max="20">
      </div>
      <div class="form-group col-3">
        <label for="bedNum">Numero letti:</label>
        <input class="form-control" type="number" name="bedNum" value="{{$apartment->bedNum}}" min="0" max="20">
      </div>
      <div class="form-group col-3">
        <label for="mQ">Metri quadrati:</label>
        <input class="form-control" type="number" name="mQ" value="{{$apartment->mQ}}" min="0">
      </div>
      <div class="form-group col-3">
        <label for="wcNum">Bagni:</label>
        <input class="form-control" type="number" name="wcNum" value="{{$apartment->wcNum}}" min="0" max="20">
      </div>
    </div>
    <div class="form-group">
      <label for="visible">Visibilità dell'annuncio</label>
      {{-- <input class="form-control" type="text" name="visible" value="{{$apartment->wcNum}}"> --}}
      <select name="visible" class="form-control" id="visible">
        <option value="1" selected>pubblica</option>
        <option value="0" selected>nascosta</option>
      </select>
  
    </div>
    <div class="row">
      <div class="form-group col-8">
        <label for="services">Servizi:</label> <br>
        @foreach ($services as $service)
        <input name="services[]" type="checkbox"  value="{{$service->id}}"
        @if ($apartment->services()-> find($service->id))
        checked
        @endif>
        <p class="mr-4" style="display:inline;">{{$service->name}}</p>
        @endforeach
      </div> 
    </div>
    <button type="submit">SALVA</button>
  </form>
</div>
        
@endsection