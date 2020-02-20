@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="hero col-md-12">
            <div class="row align-items-center">
                <div class="col-3 heroSearch p-5 m-5">
                    <h3>
                        <b> Prenota alloggi unici</b>
                    </h3>
                    <form action="{{route('apartment.search')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="address">Dove vuoi andare?</label>
                            <input type="text" name="address" id="address" class="form-control input-lg" autocomplete="off" placeholder="Es: Milano"/>
                            <div id="addressList">
                            </div>
                        </div> 
                        <span class="form-group">
                            <label for="roomNum">Numero Stanze:</label>
                            <input type="number" name="roomNum" id="" class="form-control" autocomplete="off" value ="1"/>
                            <label for="bedNum">Numero Letti:</label>
                            <input type="number" name="bedNum" id="" class="form-control" autocomplete="off" value ="1"/>
                        </span>
                        <div class="form-group position">
                            <input type="text" name="latitude" id="latitude"/>
                            <input type="text" name="longitude" id="longitude"/> 
                        </div>
                        <div class="form-group">
                            <label for="address">Radius in km:</label>
                            <input type="number" name="radius" id="radius" class="" value ="20"autocomplete="off"/>
                            <div id="addressList">
                            </div>
                        </div>
                        <span class="form-group col-8">
                            <label for="services">Servizi:</label> <br>
                            @foreach ($services as $service)
                            <input name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
                            @endforeach
                        </span> 
                        <br>
                        <button type="submit">CERCA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4 p-5">
        <div class="col-md-12 mt-3">
            <h1 class="text-center mb-5">Appartamenti in evidenza</h1>
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
            
        </div>
    </div>
</div>
@endsection
