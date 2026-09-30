<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::patch('/activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::patch('/activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');
Route::get('/activities-trash', [ActivityController::class, 'trash'])->name('activities.trash');
Route::patch('/activities/{id}/restore', [ActivityController::class, 'restore'])
    ->name('activities.restore')
    ->withTrashed();
Route::post('/activities/{activity}/register', [RegistrationController::class, 'store'])
    ->name('activities.register');

Route::resource('activities', ActivityController::class);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'store', 'destroy']);