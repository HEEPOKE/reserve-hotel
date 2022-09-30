<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoomsController;
use App\Http\Controllers\Api\ReserveController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\ReservesallController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyroomsController;
use App\Http\Controllers\Api\MainController as MainController;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Customers;
use App\Models\Rooms;
use App\Models\Reserve;
use App\Models\Provider_payment_methods;
// use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('company', CompanyController::class);
Route::apiResource('company/{id}/rooms', CompanyroomsController::class);
Route::apiResource('rooms', RoomsController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('reserves', ReserveController::class);
Route::apiResource('customers', CustomersController::class);
Route::apiResource('reservesall', ReservesallController::class);
// Route::apiResource('reservesall/{id}', ReservesallController::class);

Route::put('reservesall/{id}', [\App\Http\Cpntroller\Api\ReservesallController::class, 'update']);


/////////////////////////////////////////////////////////////////////////
// Route::get('login', function () {
//     abort(401);
// })->name('login');

// Route::post('login', function () {
//     $credentials = request()->only(['email','password']);

//     if(!auth()->validate($credentials)) {
//         abort(401);
//     } else {
//         $user = User::where('email', $credentials['email'])->first();
//         // dd($user->tokens()->count());
//         $user->tokens()->delete();
//         $token = $user->createToken('postman', ['admin']);
//         return response()->json(['token' => $token->plainTextToken]);
//     }
// });

// Route::group(['middleware' => 'auth:sanctum'], function () {
Route::get('numbers', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    return response()->json([1, 2, 3, 4, 5]);
    // } else {
    //     abort(403);
    // }
});
/////////////////////////////////  Provider  //////////////////////////////////
Route::get('dashboardprovider', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {

    return response()->json();
    // } else {
    //     abort(403);
    // }
});
Route::get('detailprovider', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['users'] = User::orderBy('users.id','asc')->where('users.role','0')
    ->join('companies', 'companies.id', '=', 'users.company_id')
    ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
Route::get('paymentprovider', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['Provider_payment_methods'] = Provider_payment_methods::orderBy('banks.id','asc')
    ->join('banks', 'banks.id', '=', 'Provider_payment_methods.bank_id')
    ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
/////////////////////////////////  Company  ///////////////////////////////////
Route::get('dashboardcompany', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {

    return response()->json();
    // } else {
    //     abort(403);
    // }
});
Route::get('detailcompany', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
        $data['users'] = User::orderBy('users.id', 'asc')->where('users.role', '0')
        // ->where('users.id', auth()->user()->id)
        ->join('companies', 'companies.id', '=', 'users.company_id')
        ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
Route::get('manageuser', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['customers'] = Customers::orderBy('checkin_checkouts.id', 'asc')
    ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
    ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
Route::get('paymentcompany', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['Provider_payment_methods'] = Provider_payment_methods::orderBy('banks.id', 'asc')
    ->join('banks', 'banks.id', '=', 'Provider_payment_methods.bank_id')
    // ->where('Provider_payment_methods.company_id', auth()->user()->company_id)
    ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
Route::get('manageroom', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['rooms'] = Rooms::orderBy('id', 'asc')
    // ->where('company_id', auth()->user()->company_id)
    ->get();
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});


Route::get('detailreserve', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
    $data['reserves'] = Reserve::orderBy('reserves.id','asc')
    ->join('customers', 'customers.id', '=', 'reserves.customer_id')
    ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
    ->paginate(5);
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
Route::get('reportreserves', function(){
    $user = auth()->user();
    // if($user->tokenCan('admin')) {
        $data=Reserve::select('room_name')
        ->join('customers', 'customers.id', '=', 'reserves.customer_id')
        ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
        ->get();
        ////  อย่าลืมลบ->get();  /////
        // ->where('company_id', auth()->user()->company_id)
        // ->get()
        // ->groupBy(function($data){
        //     return Carbon::parse($data->customer_id)->format($data->room_name);
        // });

        // $roomsall=[];
        // $roomallCount=[];

        // foreach($data as $roomall => $values){
        //     $roomsall[]=$roomall;
        //     $roomallCount[]=count($values);
        //     // $customer[]=$data;
        //     // dd($customer);
        // }
    return response()->json($data);
    // } else {
    //     abort(403);
    // }
});
// });

Route::get('/manageroom', [MainController::class, 'index']);

