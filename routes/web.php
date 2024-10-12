<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('departments', DepartmentController::class)->names([
        'index' => 'admin.departments.index',
        'create' => 'admin.departments.create',
        'store' => 'admin.departments.store',
        'show' => 'admin.departments.show',
        'edit' => 'admin.departments.edit',
        'update' => 'admin.departments.update',
        'destroy' => 'admin.departments.destroy',
    ]);

    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'admin.employees.index',
        'create' => 'admin.employees.create',
        'store' => 'admin.employees.store',
        'show' => 'admin.employees.show',
        'edit' => 'admin.employees.edit',
        'update' => 'admin.employees.update',
        'destroy' => 'admin.employees.destroy',
    ]);
});

// Redirect users to login if they try to access admin routes without authentication
Route::redirect('/admin', '/login')->name('admin.login');

Route::get('/test-404', function () {
    abort(404);
});
Route::get('/test-403', function () {
    abort(403);
});
Route::get('/test-500', function () {
    throw new \Exception('Test 500 error');
});
