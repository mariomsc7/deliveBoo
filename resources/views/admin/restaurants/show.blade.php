@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{$restaurant->name}}</h1>
        <a class="btn btn-success text-uppercase pr-3 pl-3" href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
        <div>
            P.IVA: <span>{{ $restaurant->vat_number }}</span><br >
            Address: <span> {{ $restaurant->address }} </span><br >
            Types: @foreach ($restaurant->types as $type)
                    <span>
                        {{ $type->name }}
                    </span>
                @endforeach
        </div>
    </div>
@endsection