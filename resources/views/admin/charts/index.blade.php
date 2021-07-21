@extends('layouts.app')

@section('content')
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Laravel Chart Example</title>
        <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       <!-- Fontawesome CSS -->
</head>
      <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading my-2">Chart</div>
                    <div class="col-lg-8">
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <!-- CHARTS -->
        <script>
            var ctx = document.getElementById('userChart').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels:  {!!json_encode($chart->labels)!!} ,
                // datasets: [
                //     {
                //         label: 'Count of customers',
                //         backgroundColor: {!! json_encode($chart->colours)!!} ,
                //         data:  {!! json_encode($chart->dataset)!!} ,   
                //     },
                // ]
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                label: 'Grafico',
                data:  {!! json_encode($chart->dataset)!!}
                //data: [65, 59, 80, 81, 26, 55, 40],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
            }]
            },
// Configuration options go here
        options: {
            animations: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: false
    },
    scales: {
      y: { // defining min and max so hiding the dataset does not change scale range
        min: 0,
        max: 100
      }
    }
  }
    });
</script>
</body>
</html>
@endsection