@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Department Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $department->name }}</h5>
                <p class="card-text">ID: {{ $department->id }}</p>
                <h6>Employees:</h6>
                <ul>
                    @foreach ($department->employees as $employee)
                        <li>{{ $employee->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
