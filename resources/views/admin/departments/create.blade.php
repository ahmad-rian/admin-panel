@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Department</h1>
        <form action="{{ route('admin.departments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>
@endsection
