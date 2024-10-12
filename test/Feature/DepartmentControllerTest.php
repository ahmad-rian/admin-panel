<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_view_departments_list()
    {
        $department = Department::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.departments.index'));

        $response->assertStatus(200);
        $response->assertSee($department->name);
    }

    public function test_admin_can_create_department()
    {
        $departmentData = ['name' => 'New Department'];

        $response = $this->actingAs($this->admin)->post(route('admin.departments.store'), $departmentData);

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseHas('departments', $departmentData);
    }

    public function test_admin_can_update_department()
    {
        $department = Department::factory()->create();
        $updatedData = ['name' => 'Updated Department'];

        $response = $this->actingAs($this->admin)->put(route('admin.departments.update', $department), $updatedData);

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseHas('departments', $updatedData);
    }

    public function test_admin_can_delete_department()
    {
        $department = Department::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.departments.destroy', $department));

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    public function test_admin_can_search_departments()
    {
        $department1 = Department::factory()->create(['name' => 'Marketing']);
        $department2 = Department::factory()->create(['name' => 'Sales']);

        $response = $this->actingAs($this->admin)->get(route('admin.departments.index', ['search' => 'Marketing']));

        $response->assertStatus(200);
        $response->assertSee($department1->name);
        $response->assertDontSee($department2->name);
    }
}
