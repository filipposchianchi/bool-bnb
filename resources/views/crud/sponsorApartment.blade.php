@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row p-5 justify-content-between align-items-center">
        {{-- apartment info --}}
        <div class="card col-xs-12 col-md-5">
            <img class="card-img-top" src="{{asset('images/'.$apartment -> image)}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><strong>Nome appartamento:</strong> {{$apartment -> title}}</h5>
                <p class="card-text"><strong>Indirizzo:</strong> {{$apartment -> address}}</p>
                <p class="card-text"><strong>Descrizione:</strong> {{$apartment -> description}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><small class="text-muted">Aggiunto il: {{$apartment -> created_at -> format('d-m-y')}}</small></li>
            </ul>
            <div class="card-body text-center">
                <a href="{{route('apartmentShow', $apartment -> id)}}" class="card-link btn btn-primary">visualizza appartamento</a>
            </div>
        </div>
        {{-- billing info --}}
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('apartment.process') }}" method="GET">
              @csrf
                <div class="form-group">
                    <label for="sponsor"><h4>Scegli uno dei seguenti pacchetti promozionali</h4></label>
                    <select name="prezzo"id="sponsor" class="form-control">
                      <option selected disabled>pacchetti..</option>
                      <option value="2.99">2.99 € per 24 ore di sponsorizzazione</option>
                      <option value="5.99">5.99 € per 72 ore di sponsorizzazione</option>
                      <option value="9.99">9.99 € per 144 ore di sponsorizzazione</option>
                    </select>
                  </div>
                  <input type="submit" value="Submit" class="btn btn-primary">
              </form>
              <div class="col-12">
                <div class="row">
                  <div class="col-md-12 col-md-offset-2">
                    <div id="dropin-container"></div>
                    <button id="submit-button">Request payment method</button>
                  </div>
                </div>
             </div>
        </div>
        
    </div>
</div>
<script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('apartment.process') }}', {payload}, function (response) {
            if (response.success) {
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
</script>
@endsection