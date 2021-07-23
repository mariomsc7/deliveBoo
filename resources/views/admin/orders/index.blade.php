@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Order of
            <strong>{{ session('deleted') }}</strong>
            successfully deleted
        </div>
        @endif
        <h1>Storico Ordini</h1>
        <a class="btn btn-primary text-uppercase mr-3" href="{{route('admin.restaurants.show', $restaurant->id)}}">Ritorna al ristorante</a>
        <a class="btn btn-success text-uppercase" href="{{route('admin.charts.show', $restaurant->id)}}">Mostra Grafico Ordini</a>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Data e Ora</th>
                    <th>Nome Cliente</th>
                    <th>Importo Pagato</th>
                    <th colspan="2">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->customer_name}} {{$order->customer_lastname}}</td>
                        <td>€{{number_format($order->tot_paid, 2)}}</td>   
                        <td>
                            <a class="btn btn-primary " href="{{route('admin.orders.show', $order->id)}}">Mostra Dettagli</a>
                        </td> 
                        <td>
                            <form class="delete-form" action="{{route('admin.orders.destroy', $order->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="CANCELLA ORDINE">
                            </form>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>            
    </div>
    
@endsection