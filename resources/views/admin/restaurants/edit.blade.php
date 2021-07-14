@extends('layouts.app')
@section('content')

     <div class="container">
    <h1>EDIT Restaurant 
        <a href="{{route('admin.restaurants.show', $restaurant->id)}}">{{$restaurant->name}}</a> </h1>
    <form method="POST" action="{{route('admin.restaurants.update', $restaurant->id)}}">
        @csrf
        @method('PATCH')


        <div class="mb-3">
            <label for="name" class="control-table">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name', $restaurant->name)}}" required maxlength="50">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="vat_number" class="control-table">P.IVA</label>
            <textarea class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" rows="10" required>{{old('vat_number.name', $restaurant->vat_number)}}</textarea>
            @error('vat_number')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="control-table">Address</label>
            <textarea class="form-control @error('ingredients') is-invalid @enderror" id="address" name="address" rows="10" required>{{old('adress.name', $restaurant->address)}}</textarea>
            @error('address')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3 d-flex flex-column align-items-center text-uppercase">
                <h4>Restaurant types</h4>
                <ul>
                    @foreach ($types as $type)
                    <li class="list-unstyled">
                    <input class="@error('types') is-invalid @enderror" type="checkbox" name="types[]" id="type{{ $loop->iteration }}"
                        value="{{ $type->id}}" 
                       @if ($errors->any() && in_array($type->id, old('types'))) 
                                        checked
                                    @elseif (! $errors->any() && $restaurant->types->contains($type->id))
                                        checked  
                                    @endif>
                    <label for="type{{ $loop->iteration }}">
                        {{$type->name}}
                    </label>
                </li>
                @endforeach
                </ul>
                
                @error('types')
                    
                        <div class="invalid-feedback">{{ $message }}</div>
               
                @enderror
            </div>
        <button type="submit" class="btn btn-success text-uppercase pr-3 pl-3">Save</button>

        
    </form>
   </div>
    
@endsection