<?php

namespace Tests\Unit;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_employee()
    {
        $employee = Employee::factory()->create();
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
    }

    public function test_employee_belongs_to_department()
    {
        $department = Department::factory()->create();
        $employee = Employee::factory()->create(['department_id' => $department->id]);

        $this->assertInstanceOf(Department::class, $employee->department);
        $this->assertEquals($department->id, $employee->department->id);
    }
}
