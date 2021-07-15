@extends('layouts.app')

@section('content')

   <div class="container">
    <h1>EDIT DISH 
        <a href="{{route('admin.dishes.show', $dish->id)}}">{{$dish->name}}</a> 
    </h1>
    <form method="POST" action="{{route('admin.dishes.update', $dish->id)}}">
        @csrf
        @method('PATCH')


        <div class="mb-3">
            <label for="name" class="control-table">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $dish->name)}}" required maxlength="50">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ingredients" class="control-table">Ingredients</label>
            <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" rows="10" required>{{old('ingredients.name', $dish->ingredients)}}</textarea>
            @error('ingredients')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="control-table">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{old('description.name', $dish->description)}}</textarea>
            @error('description')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="control-table">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{old('price', $dish->price)}}" required>
            @error('price')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="visibility" class="control-table mr-3">VISIBLE: </label>
            <input type="checkbox" name="visibility" id="visibility"  checked>
        </div>
        <div class="mb-3">
            image
        </div>
        <button type="submit" class="btn btn-success text-uppercase pr-3 pl-3">Save</button>

        
    </form>
   </div>

@endsection