@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Departments</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('admin.departments.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search departments..."
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">Add New Department</a>
            </div>
        </div>

        @if (request('search'))
            <p>Search results for: <strong>{{ request('search') }}</strong></p>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $department)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $department->name }}</td>
                        <td>
                            <a href="{{ route('admin.departments.show', $department) }}"
                                class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.departments.edit', $department) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.departments.destroy', $department) }}" method="POST"
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
                        <td colspan="3" class="text-center">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $departments->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endpush
