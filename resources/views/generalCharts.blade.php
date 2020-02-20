@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-around p-5">
        <h2>Statistiche generali degli appartamenti</h2>
        <div class="col-6">

            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
    <script>
        var apartments = @json($apartments);
        var messagesCount = @json($messagesCount);
        var apartmentsName = [];
        var apartmentsData = [];
        apartments.forEach(apartment => {
            apartmentsName.push(apartment['title']);
            apartmentsData.push(apartment['view']);
        });
        console.log(apartmentsData);
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: apartmentsName,
                datasets: [{
                    label: 'Visualizzazioni',
                    backgroundColor:'rgba(255, 99, 132, 0.2)',
                    data: apartmentsData,
                    borderWidth: 1
                },
                {
                    label: "Messaggi",
                    backgroundColor: "skyblue",
                    data: messagesCount
                }
            ]},
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
@endsection