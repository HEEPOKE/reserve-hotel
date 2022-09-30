<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailproviderController;
use App\Http\Controllers\License_statusController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Auth\ForgotPasswordController;

// Route::resource('companies', HomeController::class);

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

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/////////////////////// home //////////////////////
Route::get('dashboardprovider',[App\Http\Controllers\HomeController::class, 'dashboardprovider'])->name('dashboardprovider.home')->middleware('role');
Route::get('detailprovider',[App\Http\Controllers\HomeController::class, 'detailprovider'])->name('provider.home')->middleware('role');

Route::get('dashboardcompany',[App\Http\Controllers\HomeController::class, 'dashboardcompany'])->name('dashboardcompany.home')->middleware('role');
Route::get('detailcompany',[App\Http\Controllers\HomeController::class, 'detailcompany'])->name('company.home')->middleware('role');

Route::get('license_status',[App\Http\Controllers\HomeController::class, 'license_status'])->name('license_status.home')->middleware('role');
Route::get('paymentprovider',[App\Http\Controllers\HomeController::class, 'paymentprovider'])->name('paymentprovider.home')->middleware('role');
// Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);


/////////////////////// Detaiprovider //////////////////////
Route::post('insert-provider',[DetailproviderController::class, 'insert']);
Route::get('delete-provider/{id}', [DetailproviderController::class, 'delete']);
Route::get('update/{id}', [DetailproviderController::class, 'update']);
//////////////////////////////////////////////////////////
//////////////////////  License_status //////////////////////
Route::post('insert-license',[License_statusController::class, 'insert']);

// Route::post('update-license/{id}',[License_statusController::class, 'update']);
//////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////

Route::get('/detailcompany', function () {
    return view('companypages.company_dashboardcompany');
});

Route::get('/manageroom', function () {
    return view('companypages.company_manageroom');
});

Route::get('/informationcompany', function () {
    return view('companypages.company_informationcompany');
});

Route::get('/manageusers', function () {
    return view('companypages.company_manageusers');
});

Route::get('/detailreserve', function () {
    return view('companypages.company_detailreserve');
});

Route::get('/detailcustomer', function () {
    return view('companypages.company_detailcustomer');
});

Route::get('/chartcompany_day', function () {
    return view('companypages.company_chartcompany_day');
});

Route::get('/chartcompanymonth_year', function () {
    return view('companypages.company_chartcompanymonth_year');
});

