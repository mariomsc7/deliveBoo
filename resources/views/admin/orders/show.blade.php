@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ordine del cliente: <span class="text-primary">{{$order->customer_name}} {{$order->customer_lastname}}</span></h1>
        <h3>Recapito Telefonico: {{$order->phone_number}}</h3>
        <h3>Indirizzo: {{$order->customer_address}}</h3>
        <h3>Importo Pagato: {{$order->tot_paid}}€</h3>
        <h3>Data & Ora: <span class="text-primary">{{$order->created_at}}</span></h3>
        <a class="btn btn-primary" href="{{route('admin.orders.index')}}">Torna allo Storico Ordini</a>
    </div>
@endsection