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
      <input class="form-control" type="text" name="address" value="{{$apartment->address}}">
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
      <input class="form-control" type="text" name="roomNum" value="{{$apartment->roomNum}}">
    </div>
    <div class="form-group">
      <label for="bedNum">Bed numbers:</label>
      <input class="form-control" type="text" name="bedNum" value="{{$apartment->bedNum}}">
    </div>
    <div class="form-group">
      <label for="mQ">Metri quadrati:</label>
      <input class="form-control" type="text" name="mQ" value="{{$apartment->mQ}}">
    </div>
    <div class="form-group">
      <label for="wcNum">Toilette:</label>
      <input class="form-control" type="text" name="wcNum" value="{{$apartment->wcNum}}">
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