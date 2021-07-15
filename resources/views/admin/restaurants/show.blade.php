@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-5">{{$restaurant->name}}</h1>
                <a class="btn btn-primary text-uppercase" href="{{route('admin.dishes.index')}}">Go to Menu</a>
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
            @if ($restaurant->image)
                <div class="col-md-6">
                    <img class="img-fluid" src="{{asset('storage/' . $restaurant->image)}}" alt="{{$restaurant->name}}">
                </div>
            @endif
        </div>
    </div>
@endsection