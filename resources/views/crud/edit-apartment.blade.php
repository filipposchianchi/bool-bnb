@extends('layouts.app')
@section('content')

<div class="container">
  <form action="{{route('apartment.update', $apartment -> id)}}" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title:</label>
      <input class="form-control" type="text" name="title" value="{{$apartment->title}}">
    </div>
    <div class="form-group">
      <label for="address">address:</label>
      <input class="" type="text" name="countryCode" value="{{$apartment-> countryCode}}" >
      <input class="" type="number" name="streetNumber" value="{{$apartment-> streetNumber}}">
      <input class="" type="text" name="streetName" value="{{$apartment-> streetName}}" >
      <input class="" type="text" name="municipality" value="{{$apartment-> municipality}}" >
      <input class="" type="text" name="postalCode" value="{{$apartment-> postalCode}}">
    </div> 
    <div class="form-group">
      <label for="description">description:</label>
      <input class="form-control" type="text" name="description" value="{{$apartment->description}}">
    </div>
    <div class="form-group">
      <label for="img">img:</label>
      <input class="form-control" type="text" name="img" value="{{$apartment->img}}">
    </div>
    <div class="form-group">
      <label for="roomNum">Room Num:</label>
      {{-- <input class="form-control" type="text" name="roomNum" value="{{$apartment->roomNum}}"> --}}
      <input class="form-control" type="number" name="roomNum" value="1" min="0" max="20">
    </div>
    <div class="form-group">
      <label for="bedNum">Bed numbers:</label>
      {{-- <input class="form-control" type="text" name="bedNum" value="{{$apartment->bedNum}}"> --}}
      <input class="form-control" type="number" name="bedNum" value="1" min="0" max="20">
    </div>
    <div class="form-group">
      <label for="mQ">Metri quadrati:</label>
      {{-- <input class="form-control" type="text" name="mQ" value="{{$apartment->mQ}}"> --}}
      <input class="form-control" type="number" name="mQ" value="1" min="0">
    </div>
    <div class="form-group">
      <label for="wcNum">Toilette:</label>
      {{-- <input class="form-control" type="text" name="wcNum" value="{{$apartment->wcNum}}"> --}}
      <input class="form-control" type="number" name="wcNum" value="1" min="0" max="20">
    </div>
    <div class="form-group">
      <label for="visible">Visibilità dell'annuncio</label>
      {{-- <input class="form-control" type="text" name="visible" value="{{$apartment->wcNum}}"> --}}
      <select name="visible" class="form-control" id="visible">
        <option value="1" selected>pubblica</option>
        <option value="0" selected>nascosta</option>
      </select>
  
    </div>
    <div class="form-group col-8">
      <label for="services">Services:</label> <br>
      @foreach ($services as $service)
      <input name="services[]" type="checkbox"  value="{{$service->id}}"
      @if ($apartment->services()-> find($service->id))
          checked
      @endif
      >{{$service->name}}
      @endforeach
  </div> 
    <button type="submit">SALVA</button>
  </form>
</div>
        
@endsection