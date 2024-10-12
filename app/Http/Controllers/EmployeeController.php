<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Employee::with('department');

            if ($request->has('search')) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('department', function ($q) use ($searchTerm) {
                            $q->where('name', 'LIKE', "%{$searchTerm}%");
                        });
                });
            }

            $employees = $query->paginate(10);

            return view('admin.employees.index', compact('employees'));
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred while fetching employees: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees',
                'department_id' => 'required|exists:departments,id',
            ]);

            Employee::create($validated);

            return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the employee: ' . $e->getMessage());
        }
    }

    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:employees,email,' . $employee->id,
                'department_id' => 'required|exists:departments,id',
            ]);

            $employee->update($validated);

            return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the employee: ' . $e->getMessage());
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.employees.index')->with('error', 'An error occurred while deleting the employee: ' . $e->getMessage());
        }
    }
}
