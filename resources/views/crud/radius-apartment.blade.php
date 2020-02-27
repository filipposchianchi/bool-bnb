@extends('layouts.app')
@section('content')
    <a href="#" class="float" id="float-but" style="z-index:99999">
        <i  class="fa fa-search my-float" data-toggle="modal" data-target="#exampleModal"></i>
    </a>
    <div class="container-fluid " style="padding-left: 0px;padding-right: 0px;">
        
        <div class="search-section  ">

            <div class=" justify-content-center">
                <h2 class="text-center pt-4 mb-3">Appartamenti in evidenza</h2>
                @if ($apartmentsAdvert -> isEmpty())
                <h6 class="row justify-content-center"">Non ci sono appartamenti sponsorizzati</h6>          
                @endif
            </div>
            
            
            <div class="d-flex justify-content-center">
                <div id="myCarousel" class=" mb-4 col-9 col-sm-9 col-md-5 carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($apartmentsAdvert as $key => $apartment)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">  
                            <div class="box mx-3 card mb-3 testclass altezza">
                                <a class="m-3 mx-auto" href="{{route('apartmentShow', $apartment -> id)}}">
                                    <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$apartment -> title}}</h5>
                                        <p class="card-text ellipsis">{{$apartment -> address}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                    <i class="fas fa-chevron-left freccia-sinistra" ></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <i class="fas fa-chevron-right freccia-destra"></i>
                </a>
            </div>
        </div>
    </div>
        
    </div>
        

    <div class="container-fluid ">
        <div class=" p-5 justify-content-center">
            @if($apartments == null )
                <div class="row align-items-center justify-content-center mt-3">
                    <div class="col-12 text-center">

                        <h2>
                            Mi dispiace non ci sono appartamenti nella zona.<br>(Prova ad allargare l'area della ricerca)
                        </h2>
                    </div>
                    <div class="row justify-content-center">

                        <img class="col-12" src="{{asset('images/404.png')}}" alt="">
                    </div>
                </div>
                
            @else
                <div>
                    <h2 class="text-center mt-3">Risultati ricerca</h2>
                    <div class="container-fluid w-75">

                        <div class="row">
                            
                            <h6 class=" col-12 col-sm-10 m-auto text-center bg-info rounded p-2" style="line-height: 1.9;">

                                Stai cercando case nell'arco di <span class="font-weight-bold">{{$searchParam[1]}}</span> km da <span class="font-weight-bold">{{$searchParam[0]}}</span> con almeno <span class="font-weight-bold">{{$searchParam[4]}}</span> camera/e ed almeno <span class="font-weight-bold">{{$searchParam[5]}}</span> posto/i letto. 
                                @if(!$servicesQuery == null)
                                Con i seguenti servizi: 
                                @foreach ($servicesQuery as $serviceQuery)
                                @if($serviceQuery === '1' )
                                <span class="font-weight-bold">Wi-fi</span>
                                @elseif($serviceQuery === '2' )</span>
                                <span class="font-weight-bold">Posto macchina
                                    @elseif($serviceQuery=== '3' )
                                    <span class="font-weight-bold">Piscina</span>
                                    @elseif($serviceQuery === '4' )
                                    <span class="font-weight-bold">Portineria</span>
                                    @elseif($serviceQuery === '5' )
                                    <span class="font-weight-bold">Sauna</span>
                                    @elseif($serviceQuery === '6' )
                                    <span class="font-weight-bold">Vista mare</span>
                                    @endif
                                    @endforeach
                                    @endif
                            </h6> 
                            {{-- <div class=" col-12  col-sm-2 d-flex mt-1  mt-md-0 ">
                                    <button id="newSearch" type="submit" class=" mx-auto align-self-center row btn btn-primary ">Nuova<br>ricerca</button>
                            </div> --}}
                                
                        </div>
                    </div>
                    <div class=" mt-3 card-deck d-flex justify-content-center align-items-center  flex-wrap">
                        {{-- if sponsored --}}
                        @foreach ($apartments as $apartment)
                        <div class="apartment col-xs-12">
                            <div class="{{ ($apartment -> sponsored > 0) ? "sponsored" : "" }} box mx-3 card mb-3 " style="width:300px; height: 350px;" >
                                <a class="m-3 mx-auto" href="{{route('apartmentShow', $apartment -> id)}}">
                                    <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top imgstyle" alt="..." ">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$apartment -> title}}</h5>
                                        <p class="card-text ">{{$apartment -> address}}</p>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuova ricerca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-box p-3 col-ms-8">
            
                <form  action="{{route('apartment.search')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="address">Dove vuoi andare?</label>
                        <input type="text" name="address" id="address" class="form-control input-lg text-center" autocomplete="off" placeholder="{{$address}}" required/>
                        <div id="addressList">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="roomNum">Numero Stanze:</label>
                            <input type="number" name="roomNum" id="" class="form-control" autocomplete="off" value ="1"/>
                        </div>
                        <div class="col-4">
                            <label for="bedNum">Numero Letti:</label>
                            <input type="number" name="bedNum" id="" class="form-control" autocomplete="off" value ="1"/>
                        </div>
                        <div class="col-4">
                            <label for="address">Radius in km:</label>
                            <input type="number" name="radius" id="radius" class="form-control" value ="20"autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group position">
                        <input type="text" name="latitude" id="latitude"/>
                        <input type="text" name="longitude" id="longitude"/> 
                    </div>
                    <span class="form-group  col-8 py-2">
                        <label for="services">Servizi:</label> <br>
                        @foreach ($services as $service)
                        <input class="mr-1"name="services[]" type="checkbox"  value="{{$service->id}}">{{$service->name}}
                        @endforeach
                    </span> <br>
                    <button type="submit" class="btn btn-primary col-4 ">CERCA</button>
                </form>
            </div>
          
        </div>
        
      </div>
    </div>
  </div>

    <script>
        $(document).ready(function(){
            
            $("#float-but").click(function(){
                
                $('#exampleModal').modal('show')
                
                
            }); 
        });    
    
    </script>
    

@endsection

