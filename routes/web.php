<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Layout.main');
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
