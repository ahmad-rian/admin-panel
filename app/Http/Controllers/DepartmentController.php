<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Department::query();

            if ($request->has('search')) {
                $searchTerm = $request->search;
                $query->where('name', 'LIKE', "%{$searchTerm}%");
            }

            $departments = $query->paginate(10);

            return view('admin.departments.index', compact('departments'));
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred while fetching departments: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255|unique:departments',
            ]);

            Department::create($validated);

            return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the department: ' . $e->getMessage());
        }
    }

    public function show(Department $department)
    {
        return view('admin.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255|unique:departments,name,' . $department->id,
            ]);

            $department->update($validated);

            return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the department: ' . $e->getMessage());
        }
    }

    public function destroy(Department $department)
    {
        try {
            if ($department->employees()->count() > 0) {
                return redirect()->route('admin.departments.index')->with('error', 'Cannot delete department with employees.');
            }

            $department->delete();

            return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.departments.index')->with('error', 'An error occurred while deleting the department: ' . $e->getMessage());
        }
    }
}
