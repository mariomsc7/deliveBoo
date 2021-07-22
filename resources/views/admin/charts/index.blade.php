@extends('layouts.app')

@section('content')
        <div class="container">
            <div>{{$chart}}</div>
            <div class="row">
                <div class="col-md-10">
                    {{-- <div class="col-lg-8"> --}}
                        <canvas id="userChart" class="rounded shadow"></canvas>
                    {{-- </div> --}}
                </div>
            </div>
            <a class="btn btn-primary text-uppercase mt-3" href="{{route('admin.orders.index')}}">Back to order history</a>
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <!-- CHARTS -->
        <script>
            const date = {!!json_encode($chart->labels)!!};
            const order = {!!json_encode($chart->dataset)!!};
            const monthName = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
            let month = date.map(item => {
                return monthName[item - 1] 
            })
            console.log(month);
            var ctx = document.getElementById('userChart').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            // options: {
            //     scales:{
            //         x:{
            //             title:{
            //                 color:'red',
            //                 display: true,
            //                 text: 'Month',
            //             }
            //         }
            //     }
            // },
            data: {
                // labels:  {!!json_encode($chart->labels)!!} ,
                // datasets: [
                //     {
                //         label: 'Count of customers',
                //         backgroundColor: {!! json_encode($chart->colours)!!} ,
                //         data:  {!! json_encode($chart->dataset)!!} ,   
                //     },
                // ]
                // labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                labels: month,
                datasets: [{
                    label: 'Ordini',
                    // data: [65, 59, 80, 81, 26, 55, 40],
                    data:  order,
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
@endsection