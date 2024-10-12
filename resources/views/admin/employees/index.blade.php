@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employees</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('admin.employees.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search employees..."
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Add New Employee</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>
                            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete(event, this.form)">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $employees->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endpush
