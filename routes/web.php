<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;

Route::get('/', [HomeController::class, 'index']);
Route::get('/addcountry', [HomeController::class, 'addcountry']);
Route::get('/addstate', [HomeController::class, 'addstate']);
Route::get('/addcity', [HomeController::class, 'addcity']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/add-permission', [RoleController::class, 'addPermission'])->name('add-permission');
    Route::get('/details', [ProfileController::class, 'getdetails'])->middleware('permission:Add details')->name('details');

    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/role/add', [RoleController::class, 'add'])->name('role.add');
    Route::put('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');

    Route::get('/weather', [WeatherController::class, 'index'])->name('weather');
    Route::post('/getweather', [WeatherController::class, 'getweather'])->name('getweather');



    Route::get('/platform', [PlatformController::class, 'index'])->name('platform');
    Route::get('/platform/add', [PlatformController::class, 'add'])->name('platform.add');
    Route::put('/platform/store', [PlatformController::class, 'store'])->name('platform.store');
    Route::get('/platform/{id}', [PlatformController::class, 'edit'])->name('platform.edit');
    Route::put('/platform/update/{id}', [PlatformController::class, 'update'])->name('platform.update');
    Route::get('/platform/delete/{id}', [PlatformController::class, 'delete'])->name('platform.delete');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
