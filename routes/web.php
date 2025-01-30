<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Layout.main');
});
Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::post('/create', [RoleController::class, 'create'])->name('role.create');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
});
Route::prefix('group')->group(function () {
    Route::get('/', [PermissionGroupController::class, 'index'])->name('group');
    Route::post('/create', [PermissionGroupController::class, 'create'])->name('group.create');
    Route::put('/update/{group}', [PermissionGroupController::class, 'update'])->name('group.update');
    Route::delete('/delete/{group}', [PermissionGroupController::class, 'delete'])->name('group.delete');
});
Route::prefix('permission')->group(function(){
Route::get('/',[PermitController::class,'index'])->name('permission');
Route::post('/create',[PermitController::class,'create'])->name('permission.create');
Route::put('/update/{permission}',[PermitController::class,'update'])->name('permission.update');
Route::delete('/delete/{permission}',[PermitController::class,'delete'])->name('permission.delete');
});
Route::prefix('user')->group(function() {
Route::get('/',[UserController::class,'index'])->name('user');
Route::post('/create',[UserController::class,'create'])->name('user.create');
Route::put('/update/{user}',[UserController::class,'update'])->name('user.update');
});
