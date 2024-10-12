@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="display-1">403</h1>
        <p class="lead">Sorry, you don't have permission to access this page.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
    </div>
@endsection
