@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-3">{{$restaurant->name}}</h1>
        <a class="btn btn-primary text-uppercase mb-5" href="{{route('admin.dishes.index')}}">Go to Menu</a>
        
        <div>
            <h3>P.IVA: {{ $restaurant->vat_number }}</h3>
            <h3>ADDRESS: {{ $restaurant->address }}</h3>
            <h3>TYPES: 
                @foreach ($restaurant->types as $type)
                    <span>
                        {{ $type->name }}
                    </span>
                @endforeach
            </h3>
        </div>
        
        <div class="mt-5">
            <a class="btn btn-success text-uppercase pr-3 pl-3 mr-2" href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
            <a class="btn btn-warning text-uppercase mr-2" href="{{route('admin.orders.index')}}">Orders history</a>
            
            <form class="delete-form d-inline-block" action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="DELETE RESTAURANT">
            </form>
        </div>
    </div>
@endsection