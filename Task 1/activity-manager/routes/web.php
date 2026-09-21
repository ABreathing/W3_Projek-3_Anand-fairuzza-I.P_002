<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::resource('activities', ActivityController::class);