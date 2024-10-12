@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Departments</h5>
                        <p class="card-text display-4">{{ $departmentCount }}</p>
                        <a href="{{ route('admin.departments.index') }}" class="btn btn-primary">View Departments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Employees</h5>
                        <p class="card-text display-4">{{ $employeeCount }}</p>
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-primary">View Employees</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
