@extends('layouts.app')
@section('content')

<div class="container">
  <form action="{{route('apartment.store')}}" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title:</label>
      <input class="form-control" type="text" name="title" value="">
    </div>
    <div class="form-group">
      <label for="address">address:</label>
      <input class="" type="text" name="countryCode" value="" placeholder="countryCode" >
      <input class="" type="number" name="streetNumber" value="" placeholder="streetNumber">
      <input class="" type="text" name="streetName" value="" placeholder="streetName">
      <input class="" type="text" name="municipality" value="" placeholder="municipality">
      <input class="" type="text" name="postalCode" value="" placeholder="postalCode">
    </div> 
    <div class="form-group">
      <label for="description">description:</label>
      <input class="form-control" type="text" name="description" value="">
    </div>
    <div class="form-group">
      <label for="img">img:</label>
      <input class="form-control" type="text" name="img" value="">
    </div>
    <div class="form-group">
      {{-- <label for="roomNum">Room Num:</label>
      <input class="form-control" type="text" name="roomNum" value=""> --}}
      <label for="roomNum">Room Num:</label>
      <input class="form-control" type="number" name="roomNum" value="1" min="0" max="20">
    </div>
    <div class="form-group">
      <label for="bedNum">Bed numbers:</label>
      {{-- <input class="form-control" type="text" name="bedNum" value=""> --}}
      <input class="form-control" type="number" name="bedNum" value="1" min="0" max="20">
    </div>
    <div class="form-group">
      <label for="mQ">Metri quadrati:</label>
      {{-- <input class="form-control" type="text" name="mQ" value=""> --}}
      <input class="form-control" type="number" name="mQ" value="1" min="0">
    </div>
    <div class="form-group">
      <label for="wcNum">Toilette:</label>
      <input class="form-control" type="number" name="wcNum" value="1" min="0" max="20">
    </div>
    <div class="form-group col-8">
      <label for="services">Services:</label> <br>
      @foreach ($services as $service)
      <input name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
      @endforeach
  </div> 
    <button type="submit">SALVA</button>
  </form>
</div>
        
@endsection