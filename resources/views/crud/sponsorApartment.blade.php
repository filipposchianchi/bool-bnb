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
          <form method="post" id="payment-form" action="{{route('apartment.process' , $apartment -> id)}}">
            @csrf
            {{-- @method('POST') --}}
            <section>
              <div class="form-group">
                <label for="sponsor"><h4>Scegli uno dei seguenti pacchetti promozionali</h4></label>
                <select name="amount"id="amount" class="form-control" required>
                  <option selected disabled>pacchetti..</option>
                  <option value="2.99">2.99 € per 24 ore di sponsorizzazione</option>
                  <option value="5.99">5.99 € per 72 ore di sponsorizzazione</option>
                  <option value="9.99">9.99 € per 144 ore di sponsorizzazione</option>
                </select>
              </div>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Conferma</span></button>
          </form>
        </div>
        
    </div>
</div>
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ Braintree_ClientToken::generate() }}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      // paypal: {
      //   flow: 'vault'
      // }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>
@endsection