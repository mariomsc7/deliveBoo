@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$restaurant->name}} Menu</h1>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Visibility</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes as $dish)
                    <tr>
                        <td>{{$dish->id}}</td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->price}}</td>
                        <td>{{$dish->visibility ? 'True' : 'False'}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.dishes.show', $dish->id)}}">Show Details</a>
                        </td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                @endforeach
            </tbody>
        </table>            
    </div>
@endsection