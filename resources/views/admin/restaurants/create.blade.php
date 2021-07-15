@extends('layouts.app')

@section('content')

    <div class="container">
       
        <form method="POST" action="{{ route('admin.restaurants.store') }}">
            @csrf
            @method('POST')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" maxlength="30" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="vat_number" class="col-md-4 col-form-label text-md-right">{{ __('P.IVA') }}</label>

                <div class="col-md-6">
                    <input id="vat_number" type="text" class="form-control @error('vat_number') is-invalid @enderror" name="vat_number" value="{{ old('vat_number') }}" required autocomplete="vat_number" minlength="11" maxlength="11" autofocus>

                    @error('vat_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" maxlength="50" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3 d-flex flex-column align-items-center text-uppercase">
                <h4>Restaurant types</h4>
                <ul>
                    @foreach ($types as $type)
                    <li class="list-unstyled">
                    <input class="@error('types') is-invalid @enderror" type="checkbox" name="types[]" id="type{{ $loop->iteration }}"
                        value="{{ $type->id}}" 
                        @if(in_array($type->id, old('types', [])))
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

                 <button id="sub-btn" type="submit" class="text-uppercase btn btn-primary">Register</button>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                   
                </div>
            </div>    
        </form>
    </div>

@endsection