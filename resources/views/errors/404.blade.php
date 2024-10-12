@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="display-1">404</h1>
        <p class="lead">Oops! The page you're looking for doesn't exist.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    </div>
@endsection
