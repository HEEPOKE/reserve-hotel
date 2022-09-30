<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ManageroomController;
use App\Http\Controllers\ManageusersController;
use App\Http\Controllers\ManagecompanyController;
use App\Http\Controllers\BookingController;

// Route::resource('pages', HomeController::class);


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

///////////////////////////// HomeController ////////////////////////////
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboardprovider', [App\Http\Controllers\HomeController::class, 'dashboardprovider'])->name('dashboardprovider');
Route::get('/dashboardcompany', [App\Http\Controllers\HomeController::class, 'dashboardcompany'])->name('dashboardcompany');
Route::get('/detailprovider', [App\Http\Controllers\HomeController::class, 'detailprovider'])->name('detailprovider');
Route::get('/statusprovider', [App\Http\Controllers\HomeController::class, 'statusprovider'])->name('statusprovider');
Route::get('/paymentprovider', [App\Http\Controllers\HomeController::class, 'paymentprovider'])->name('paymentprovider');
Route::get('/listban', [App\Http\Controllers\HomeController::class, 'listban'])->name('listban')->name('listban');
Route::get('/dashboardban', [App\Http\Controllers\HomeController::class, 'dashboardban'])->name('dashboardban')->name('dashboardban');
Route::get('/dashboardexpire', [App\Http\Controllers\HomeController::class, 'dashboardexpire'])->name('dashboardexpire')->name('dashboardexpire');

/////////////////////////////////////////////////////////////////////////

Route::post('insert-provider', [ViewController::class, 'insert']);
Route::post('insert-employee', [ViewController::class, 'insertemployee']);
Route::get('update-provider/{id}', [ViewController::class, 'update']);
Route::post('insert-license', [ViewController::class, 'insert2']);
Route::get('update-license/{id}', [ViewController::class, 'update2']);
Route::post('insert-payment', [PaymentController::class, 'insert']);
Route::get('update-payment/{id}', [PaymentController::class, 'update3']);
Route::get('ban-provider/{id}', [ViewController::class, 'banin']);
Route::get('banout-provider/{id}', [ViewController::class, 'banout']);
Route::get('updatestatus-provider/{id}', [ViewController::class, 'updatestatus']);
Route::get('update-statusout/{id}', [ViewController::class, 'updatestatusout']);

// Route::get('provider/detailprovider',[App\Http\Controllers\CompanyCRUDController::class, 'detailprovider'])->name('detailprovider')->middleware('role');

Route::get('/manageroom', [ManageroomController::class, 'manageroom'])->name('manageroom');
Route::get('/jsonmanageroom', [ManageroomController::class, 'jsonmanageroom'])->name('jsonmanageroom');

Route::get('/detailroom', [ManageroomController::class, 'detailroom'])->name('detailroom');
Route::get('/addroom/{id}', [ManageroomController::class, 'addroom'])->name('addroom');
Route::get('/editroom/{id}', [ManageroomController::class, 'editroom'])->name('editroom');
Route::get('/paymentcompany', [App\Http\Controllers\HomeController::class, 'paymentcompany'])->name('paymentcompany');
Route::post('insert-paymentcompany', [PaymentController::class, 'insert2'])->name('insert2');
Route::get('update-paymentcompany/{id}', [PaymentController::class, 'update4'])->name('update4');

Route::post('insert_room', [ManageroomController::class, 'store'])->name('store');
Route::post('update_room/{id}', [ManageroomController::class, 'update_room'])->name('update_room');
Route::post('update_img/{id}', [ManageroomController::class, 'update_img'])->name('update_img');
Route::get('delete_room/{id}', [ManageroomController::class, 'delete_room'])->name('delete_room');
Route::post('deleteimgroom/{id}', [ManageroomController::class, 'deleteimgroom'])->name('deleteimgroom');
Route::get('detailroom/{id}', [ManageroomController::class, 'detailroom'])->name('detailroom');

Route::get('manage_typeroom', [ManageroomController::class, 'index'])->name('index');
Route::get('add_typeroom/{id}', [ManageroomController::class, 'add_typeroom'])->name('add_typeroom');
Route::post('deletetye/{id}', [ManageroomController::class, 'deletetye'])->name('deletetye');

Route::get('/detailcompany', [HomeController::class, 'detailcompany'])->name('detailcompany');
Route::get('/detailemployee', [HomeController::class, 'detailemployee'])->name('detailemployee');
Route::post('update-company/{id}', [ViewController::class, 'update4'])->name('update4');
Route::post('update-employee/{id}', [ViewController::class, 'update5'])->name('update5');

Route::post('insert-reserve', [ReserveController::class, 'insert'])->name('insert');
Route::post('update-reserves/{id}', [ReserveController::class, 'update_reserves'])->name('update_reserves');
Route::get('delete-reserves/{id}', [ReserveController::class, 'delete_reserves'])->name('delete_reserves');
Route::get('check-reserves/{id}', [ReserveController::class, 'check_reserves'])->name('check_reserves');
Route::get('payment-reserves/{id}', [ReserveController::class, 'payment_reserves'])->name('payment_reserves');
Route::post('smart-insert/{id}', [ReserveController::class, 'smart_insert'])->name('smart_insert');

Route::post('delete_slip/{id}', [ReserveController::class, 'delete_slip'])->name('delete_slip');
Route::post('manage_payment/{id}', [ReserveController::class, 'manage_payment'])->name('manage_payment');

Route::get('/detailcutomers', [HomeController::class, 'detailcutomers'])->name('detailcutomers');
Route::get('/editdetailcustomers', [ManagecompanyController::class, 'editdetailcustomer'])->name('editdetailcustomer');

Route::get('/detailbooking', [BookingController::class, 'detailbooking'])->name('detailbooking');
Route::post('insert-booking', [BookingController::class, 'insert'])->name('insert');


Route::get('/detailreserve/{id}', [ReserveController::class, 'index'])->name('index');
Route::get('/detailreserve', [ReserveController::class, 'index'])->name('index');
Route::get('/reportreserves', [HomeController::class, 'reportreserves'])->name('reportreserves');

Route::get('/manageuser', [HomeController::class, 'manageuser'])->name('manageuser');
Route::get('/manageuserdate', [HomeController::class, 'manageuserdate'])->name('manageuserdate');
Route::get('/manageusercheckin', [HomeController::class, 'manageusercheckin'])->name('manageusercheckin');
Route::get('/manageusercheckout', [HomeController::class, 'manageusercheckout'])->name('manageusercheckout');

Route::get('/userscard', [App\Http\Controllers\HomeController::class, 'userscard'])->name('userscard');

Route::post('add_customer', [ManageusersController::class, 'add_customer'])->name('add_customer');
Route::post('update_customer/{id}', [ManageusersController::class, 'update_customer'])->name('update_customer');
Route::get('delete_customer/{id}', [ManageusersController::class, 'delete_customer'])->name('delete_customer');
Route::post('/search_manageuser', [ManageusersController::class, 'search_manageuser'])->name('search_manageuser');

Route::get('/reportnewproviderYear', [ReportController::class, 'reportnewproviderYear'])->name('reportnewproviderYear');
Route::get('/reportrenewproviderYear', [ReportController::class, 'reportrenewproviderYear'])->name('reportrenewproviderYear');
Route::get('/reportrenewproviderMonth', [ReportController::class, 'reportrenewproviderMonth'])->name('reportrenewproviderMonth');
Route::get('/reportrenewproviderMonth/{id}', [ReportController::class, 'RequestproviderMonth'])->name('RequestproviderMonth');
Route::get('/reportnewproviderD&M', [ReportController::class, 'reportnewproviderDM'])->name('reportnewproviderDM');
Route::get('/reportnewproviderD&M/{id}', [ReportController::class, 'RequestproviderDM'])->name('RequestproviderDM');

Route::get('/company_reportcustomer_day', [HomeController::class, 'company_reportcustomer_day'])->name('company_reportcustomer_day');
Route::get('/company_reportcustomer_M&Y', [HomeController::class, 'company_reportcustomer_MY'])->name('company_reportcustomer_MY');

// Route::post('search-company',[HomeController::class, 'search'])->name('search');

Route::post('/findselect', [ReserveController::class, 'findselect'])->name('findselect');


Route::get('send-mail', [MailController::class, 'index'])->name('index');
