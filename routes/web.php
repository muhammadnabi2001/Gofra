<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login.login');
});
Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-page', [RoleController::class, 'page'])->name('role.create-page');
    Route::post('/create', [RoleController::class, 'create'])->name('role.create');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/update-page/{role}', [RoleController::class, 'updatepage'])->name('role.update-page');
    Route::delete('/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');

});
Route::prefix('user')->group(function() {
Route::get('/',[UserController::class,'index'])->name('user.index');
Route::post('/create',[UserController::class,'create'])->name('user.create');
Route::put('/update/{user}',[UserController::class,'update'])->name('user.update');
Route::delete('/delete/{user}',[UserController::class,'delete'])->name('user.delete');
});
Route::prefix('login')->group(function() {
    Route::get('/',[LoginController::class,'index'])->name('login');
    Route::post('/check',[LoginController::class,'check'])->name('login.check');
    Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');
});
Route::prefix('group')->group(function(){
    Route::get('/',[PermissionGroupController::class,'index'])->name('group.index');
    Route::put('/update/{group}',[PermissionGroupController::class,'update'])->name('group.update');
});
Route::prefix('permission')->group(function() {
    Route::get('/',[PermissionController::class,'index'])->name('permission.index');
    Route::put('/update/{permission}',[PermissionController::class,'update'])->name('permission.update');
    Route::put('/edit/{permission}',[PermissionController::class,'edit'])->name('permission.edit');
});
Route::prefix('department')->group(function() {
Route::get('/',[DepartmentController::class,'index'])->name('department.index');
Route::post('/create',[DepartmentController::class,'create'])->name('department.create');
});
