@extends('layouts.app')
@section('content')
    {{-- <div class="container">
        <div class="row flex-nowrap apartments">
            @foreach ($apartments as $apartment)
                <div class="col-sm-12 col-md-4 apartment">
                    <div class="box mx-3 card mb-3 ">
                        <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." style="height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$apartment -> title}}</h5>
                                <p class="card-text">{{$apartment -> address}}</p>
                                <p class="card-text">{{$apartment -> description}}</p>
                                <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('apartment.search')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="address">Dove vuoi andare?</label>
                        <input type="text" name="address" id="address" class="form-control input-lg text-center" autocomplete="off" value="{{$address}}"/>
                        <div id="addressList">
                        </div>
                    </div> 
                    <div class="form-group d-flex justify-content-around">
                        <div class="col-4">
                            <label for="roomNum">Numero Stanze:</label>
                            <input type="number" name="roomNum" id="" class="form-control" autocomplete="off" value ="1"/>
                        </div>
                        <div class="col-4">
                            <label for="bedNum">Numero Letti:</label>
                            <input type="number" name="bedNum" id="" class="form-control" autocomplete="off" value ="1"/>
                        </div>
                        <div class="col-4">
                            <label for="address">Area di ricerca(km):</label>
                            <input type="number" name="radius" id="radius" class="form-control" value ="20"autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group position">
                        <input type="text" name="latitude" id="latitude"/>
                        <input type="text" name="longitude" id="longitude"/> 
                    </div>
                    <div class="row justify-content-between">
                        <div class="form-group col-8">
                            <label for="services">Servizi:</label> <br>
                            @foreach ($services as $service)
                            <input name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
                            @endforeach
                        </div> 
                        <button type="submit" class="btn btn-primary col-4">CERCA</button>
                    </div>
                </form>
            </div>
            
        </div>
        
        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-sm-12 col-md-8 apartment">
                    <div class="box mx-3 card mb-3 ">
                        <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." style="height: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$apartment -> title}}</h5>
                                <p class="card-text">{{$apartment -> address}}</p>
                                <p class="card-text">{{$apartment -> description}}</p>
                                <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

@endsection