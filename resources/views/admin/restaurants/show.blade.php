@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{$restaurant->name}}</h1>
        <a class="btn btn-primary text-uppercase" href="{{route('admin.dishes.index')}}">Back to Menu</a>
        <a class="btn btn-success text-uppercase pr-3 pl-3" href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
        <a class="btn btn-warning text-uppercase" href="{{route('admin.orders.index')}}">Orders history</a>
        <div>
            P.IVA: <span>{{ $restaurant->vat_number }}</span><br >
            Address: <span> {{ $restaurant->address }} </span><br >
            Types: @foreach ($restaurant->types as $type)
                    <span>
                        {{ $type->name }}
                    </span>
                @endforeach
        </div>
        <div>
            <form class="delete-form" action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="DELETE RESTAURANT">
            </form>
        </div>
    </div>
@endsection