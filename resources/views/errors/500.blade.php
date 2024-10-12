@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="display-1">500</h1>
        <p class="lead">Oops! Something went wrong on our end.</p>
        <p>{{ $exception->getMessage() }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    </div>
@endsection
