<?php

use App\Http\Controllers\GymsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\UsersController;
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
define('PAGINATION_COUNT', 10);
Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//Gyms
Route::group(['prefix' => 'gym', 'middleware' => ['auth']], function () {
    Route::get('/all', [GymsController::class, 'index'])->name('gym_list');
    Route::get('/create', [GymsController::class, 'create'])->name('add_gym');
    Route::get('/show/{id}', [GymsController::class, 'show'])->name('show_gym');
    Route::post('/store',[GymsController::class, 'store'])->name('store_gym');
});

//Plans
Route::group(['prefix' => 'plans', 'middleware' => ['auth']], function () {
    Route::get('/all', [PlansController::class, 'index'])->name('plans_list');
    Route::post('/allPlansByService', [PlansController::class, 'getPlansBySrvice'])->name('allPlansByService');
    Route::post('/getPlansDays', [PlansController::class, 'getPlansDays'])->name('getPlansDays');
    Route::post('/store', [PlansController::class, 'store'])->name('plans_store');
    Route::get('/create', [PlansController::class, 'create'])->name('plans_create');
});

//Users
Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/all', [UsersController::class, 'index'])->name('users_list');
    Route::post('/store', [UsersController::class, 'store'])->name('user_store');
    Route::get('/create', [UsersController::class, 'create'])->name('users_create');
});

//Members
Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {
    Route::get('/all', [MembersController::class, 'index'])->name('members_list');
    Route::get('/create', [MembersController::class, 'create'])->name('members_create');
    Route::post('/store', [MembersController::class, 'store'])->name('members_store');
    Route::get('/show/{id}', [MembersController::class, 'show'])->name('members_show');
});

//Subscriptions
Route::group(['prefix' => 'subscriptions', 'middleware' => ['auth']], function () {
    Route::get('/all', [SubscriptionsController::class, 'index'])->name('subscriptions_list');
    Route::get('/add', [SubscriptionsController::class, 'add'])->name('subscriptions_add');
});

//Services
Route::group(['prefix' => 'services', 'middleware' => ['auth']], function () {
    Route::get('/all', [ServicesController::class, 'index'])->name('services_list');
    Route::post('/add', [ServicesController::class, 'add'])->name('services_add');
});

//Invoices
Route::group(['prefix' => 'Invoices', 'middleware' => ['auth']], function () {
    Route::get('/all', [InvoicesController::class, 'index'])->name('invioces_list');
});

//setting
Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function () {
    Route::get('/index', [SettingController::class, 'index'])->name('setting');
    Route::post('/storeLang', [SettingController::class, 'storeLang'])->name('storeLang');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
