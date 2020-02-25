@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row p-5 search-section justify-content-center align-items-center">
            <div class="form-box p-5 col-5">
                <form action="{{route('apartment.search')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="address">Dove vuoi andare?</label>
                        <input type="text" name="address" id="address" class="form-control input-lg text-center" autocomplete="off" placeholder="{{$address}}" required/>
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
                    <div class="row justify-content-between align-items-center">
                        <div class="form-group col-8">
                            <label for="services">Servizi:</label> <br>
                            @foreach ($services as $service)
                            <input name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
                            @endforeach
                        </div> 
                        <button type="submit" class="btn btn-primary col-4 ">CERCA</button>
                    </div>
                </form>
            </div>
        </div>
        

        

        <div class="">
            <div class="row p-5 justify-content-center">
                @if(($apartmentsSponsored == null) && ($apartmentsNotSponsored == null) )
                    <div class="row align-items-center justify-content-center mt-3">
                        <div class="col-8 text-center">

                            <h2>
                                Mi dispiace non ci sono appartamenti nella zona (prova ad allargare l'area della ricerca)
                            </h2>
                        </div>
                        
                        <img src="https://cdn.dribbble.com/users/1651691/screenshots/5336717/404_v2.png" alt="">
                    </div>
                    
                @else
                    <div class="card-deck ">
                        {{-- if sponsored --}}
                        @foreach ($apartmentsSponsored as $apartment)
                            <div class=" col-sm-12 col-md-4 apartment">
                                <div class="{{ ($apartment -> sponsored > 0) ? "sponsored" : "" }} box mx-3 card mb-3 ">
                                    <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                                        <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." style="height: 25rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$apartment -> title}}</h5>
                                            <p class="card-text ">{{$apartment -> address}}</p>
                                        </div>
                                        
                                    </a>
                                </div>
                            </div>
                        @endforeach


                        {{-- if not sponsored --}}
                        @foreach ($apartmentsNotSponsored as $apartment)
                            <div class=" col-sm-12 col-md-4 apartment">
                                <div class="{{ ($apartment -> sponsored > 0) ? "sponsored" : "" }} box mx-3 card mb-3 ">
                                    <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                                        <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." style="height: 25rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$apartment -> title}}</h5>
                                            <p class="card-text ">{{$apartment -> address}}</p>
                                        </div>
                                        
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    

@endsection