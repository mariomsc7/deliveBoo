@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{$restaurant->name}} Menu</h1>
        <a class="btn btn-success" href="{{route('admin.dishes.create')}}">Create</a>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Visibility</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{$dish->name}}</td>
                        <td>€{{number_format($dish->price, 2)}}</td>
                        <td>{{$dish->visibility ? 'True' : 'False'}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.dishes.show', $dish->id)}}">Show Details</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{route('admin.dishes.edit', $dish->id)}}">Edit</a>
                        </td>
                        <td>Delete</td>
                    </tr>
                @endforeach
            </tbody>
        </table>            
    </div>
@endsection