@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $employee->name }}</h5>
                <p class="card-text">ID: {{ $employee->id }}</p>
                <p class="card-text">Email: {{ $employee->email }}</p>
                <p class="card-text">Department: {{ $employee->department->name }}</p>
            </div>
        </div>
        <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
