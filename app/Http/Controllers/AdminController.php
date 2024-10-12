<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $departmentCount = Department::count();
        $employeeCount = Employee::count();

        return view('admin.dashboard', compact('departmentCount', 'employeeCount'));
    }
}
