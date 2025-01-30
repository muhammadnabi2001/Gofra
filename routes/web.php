<?php

use App\Http\Controllers\RoleController;
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