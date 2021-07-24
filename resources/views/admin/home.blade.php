@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('deleted'))
    <div class="alert alert-success">
        Ristorante
        <strong>{{ session('deleted') }}</strong>
        Cancellato con successo
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- <div class="card-info big-font"> --}}
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Log-in effettuato!') }}
                </div> --}}
                <div class="card-info big-font text-center">
                    <h1><a class="nav-link" href="{{ route('admin.restaurants.show', $user->restaurant->id) }}">{{$user->restaurant->name}}</a></h1>
                    <img width="500" src="{{asset('storage/' . $user->restaurant->image)}}" :alt="{{$user->restaurant->name}}">
                </div>
                <div>
                    @if (!$user->restaurant)
                        <a class="btn add ml-3 mb-3" href="{{ route('admin.restaurants.create') }}">Aggiungi qui il tuo ristorante</a>
                    @endif
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
