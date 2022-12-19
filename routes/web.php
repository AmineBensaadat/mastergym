<?php

use App\Http\Controllers\GymsController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//Gyms
Route::group(['prefix' => 'gym', 'middleware' => ['auth']], function () {
    Route::get('/all', [GymsController::class, 'index'])->name('gym_list');
    Route::get('/create', [GymsController::class, 'create'])->name('add_gym');
    Route::get('/show/{id}', [GymsController::class, 'show'])->name('show_gym');


    Route::post('/store',[GymsController::class, 'store'])->name('storegym');
});

//Plans
Route::group(['prefix' => 'plans', 'middleware' => ['auth']], function () {
    Route::get('/all', [PlansController::class, 'index'])->name('plans_list');
    Route::post('/store', [PlansController::class, 'add'])->name('plans_store');
    Route::get('/create', [PlansController::class, 'create'])->name('plans_create');
});

//Services
Route::group(['prefix' => 'services', 'middleware' => ['auth']], function () {
    Route::get('/all', [ServicesController::class, 'index'])->name('services_list');
    Route::post('/add', [ServicesControlller::class, 'add'])->name('services_add');
    
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
