@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Department</h1>
        <form action="{{ route('admin.departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update Department</button>
        </form>
    </div>
@endsection
