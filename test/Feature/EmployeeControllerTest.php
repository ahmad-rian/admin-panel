<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_view_employees_list()
    {
        $employee = Employee::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.employees.index'));

        $response->assertStatus(200);
        $response->assertSee($employee->name);
    }

    public function test_admin_can_create_employee()
    {
        $department = Department::factory()->create();
        $employeeData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'department_id' => $department->id
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.employees.store'), $employeeData);

        $response->assertRedirect(route('admin.employees.index'));
        $this->assertDatabaseHas('employees', $employeeData);
    }

    public function test_admin_can_update_employee()
    {
        $employee = Employee::factory()->create();
        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'department_id' => $employee->department_id
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.employees.update', $employee), $updatedData);

        $response->assertRedirect(route('admin.employees.index'));
        $this->assertDatabaseHas('employees', $updatedData);
    }

    public function test_admin_can_delete_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.employees.destroy', $employee));

        $response->assertRedirect(route('admin.employees.index'));
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }

    public function test_admin_can_search_employees()
    {
        $employee1 = Employee::factory()->create(['name' => 'John Doe']);
        $employee2 = Employee::factory()->create(['name' => 'Jane Smith']);

        $response = $this->actingAs($this->admin)->get(route('admin.employees.index', ['search' => 'John']));

        $response->assertStatus(200);
        $response->assertSee($employee1->name);
        $response->assertDontSee($employee2->name);
    }
}
