<?php

namespace Tests\Unit;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_department()
    {
        $department = Department::factory()->create();
        $this->assertInstanceOf(Department::class, $department);
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }

    public function test_department_has_many_employees()
    {
        $department = Department::factory()->create();
        $employee = Employee::factory()->create(['department_id' => $department->id]);

        $this->assertTrue($department->employees->contains($employee));
        $this->assertEquals(1, $department->employees->count());
    }
}
