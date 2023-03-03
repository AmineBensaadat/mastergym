<?php

use App\Http\Controllers\DashboardController;
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
//define('PAGINATION_COUNT', 10);
Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Gyms
Route::group(['prefix' => 'gym', 'middleware' => ['auth']], function () {
    Route::post('/switch', [GymsController::class, 'switch'])->name('gym_switch');
    Route::get('/all', [GymsController::class, 'index'])->name('gym_list');
    Route::get('/create', [GymsController::class, 'create'])->name('add_gym');
    Route::get('/show/{id}', [GymsController::class, 'show'])->name('show_gym');
    Route::post('/store',[GymsController::class, 'store'])->name('store_gym');
    Route::get('/edit/{id}', [GymsController::class, 'edit'])->name('edit_gym');
    Route::post('/update', [GymsController::class, 'update'])->name('update_gym');
});

//Plans
Route::group(['prefix' => 'plans', 'middleware' => ['auth']], function () {
    Route::get('/all', [PlansController::class, 'index'])->name('plans_list');
    Route::post('/allPlansByService', [PlansController::class, 'getPlansBySrvice'])->name('allPlansByService');
    Route::post('/getPlansDays', [PlansController::class, 'getPlansDays'])->name('getPlansDays');
    Route::post('/store', [PlansController::class, 'store'])->name('plans_store');
    Route::get('/show/{id}', [PlansController::class, 'show'])->name('show_plan');
    Route::get('/edit/{id}', [PlansController::class, 'edit'])->name('edit_plan');
    Route::get('/create', [PlansController::class, 'create'])->name('plans_create');
    Route::post('/update', [PlansController::class, 'update'])->name('update_plan');
});

//Users
Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/all', [UsersController::class, 'index'])->name('users_list');
    Route::get('/show/{id}', [UsersController::class, 'index'])->name('user_show');
    Route::post('/store', [UsersController::class, 'store'])->name('user_store');
    Route::get('/create', [UsersController::class, 'create'])->name('users_create');
    Route::post('/getAllUsers', [UsersController::class, 'getAllUsers'])->name('users_list_json');
});

//Members
Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {
    Route::get('/all', [MembersController::class, 'index'])->name('members_list');
    Route::get('/add', [MembersController::class, 'create'])->name('members_create');
    Route::get('/show/{id}', [MembersController::class, 'show'])->name('members_show');
    Route::get('/edit/{id}', [MembersController::class, 'edit'])->name('members_edit');
    Route::post('/getAllMembers', [MembersController::class, 'getAllMembers'])->name('members_list_json');
    Route::post('/getMonthlyJoiningsMembers', [MembersController::class, 'getMonthlyJoiningsMembers'])->name('Monthly_JoiningsMembers_list_json');
    Route::post('/getPendingPaimentMembers', [MembersController::class, 'getPendingPaimentMembers'])->name('Pending_PaimentMembers_list_json');
    Route::post('/getExpireMembers', [MembersController::class, 'getExpireMembers'])->name('Expire_Members_list_json');
    Route::post('/store', [MembersController::class, 'store'])->name('members_store');
    Route::post('/update', [MembersController::class, 'update'])->name('members_update');
    Route::get('/import', [MembersController::class, 'import'])->name('members_import');
    Route::post('/save_import', [MembersController::class, 'storImportMembers'])->name('import_member_store');
    Route::get('/save_import', [MembersController::class, 'downloadExceCanva'])->name('download_canva');
    Route::get('/{id}/subscription/add', [SubscriptionsController::class, 'add'])->name('member_subscription_add');
    Route::post('/getStatisticData', [DashboardController::class, 'getStatisticData'])->name('countMembersByStatus');
    Route::post('/delete', [MembersController::class, 'delete'])->name('delete_member');
    
});

//Subscriptions
Route::group(['prefix' => 'subscriptions', 'middleware' => ['auth']], function () {
    Route::get('/all', [SubscriptionsController::class, 'index'])->name('subscriptions_list');
    Route::get('/add', [SubscriptionsController::class, 'add'])->name('subscriptions_add');
    Route::get('/renwe/{subscription_id}/{member_id}', [SubscriptionsController::class, 'renwe'])->name('subscriptions_renwe');
    Route::post('/update', [SubscriptionsController::class, 'update'])->name('subscriptions_update');
    Route::post('/store', [SubscriptionsController::class, 'store'])->name('subscriptions_store');
});

//Services
Route::group(['prefix' => 'services', 'middleware' => ['auth']], function () {
    Route::get('/all', [ServicesController::class, 'index'])->name('services_list');
    Route::post('/add', [ServicesController::class, 'add'])->name('services_add');
    Route::post('/update', [ServicesController::class, 'update'])->name('services_update');
});

//Invoices
Route::group(['prefix' => 'Invoices', 'middleware' => ['auth']], function () {
    Route::get('/all', [InvoicesController::class, 'index'])->name('invioces_list');
    Route::get('/download/{id}', [InvoicesController::class, 'downloadInvoice'])->name('invoices_download');
});

//setting
Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function () {
    Route::get('/', [SettingController::class, 'index'])->name('setting');
    Route::post('/storeLang', [SettingController::class, 'storeLang'])->name('storeLang');
});

//Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
Route::get('/', [App\Http\Controllers\LendingController::class, 'index'])->name('lending');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [DashboardController::class, 'index'])->name('index');
