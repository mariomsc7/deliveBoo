@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('deleted'))
    <div class="alert alert-success">
        <strong>{{ session('deleted') }}</strong>
         Deleted Successfully
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div>
                    @if (!$user->restaurant)
                        <a class="btn btn-warning ml-3 mb-3" href="{{ route('admin.restaurants.create') }}">Add Restaurant</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
