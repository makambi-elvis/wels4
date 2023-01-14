<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HireController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectronicController;
use App\Http\Controllers\HireRequestController;

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
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

//display registration form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

//store user data

Route::post('/register', [UserController::class, 'store']);

//display login form

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');

//authenticate user

Route::post('/authenticate', [UserController::class, 'authenticate']);

//Logout user

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//delete user

Route::delete('/user/{user}', [UserController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Electronics Routes
|--------------------------------------------------------------------------
*/

//Display home page with electronics

Route::get('/', [ElectronicController::class, 'index']);

//Display create electronic form

Route::get('/electronics/create', [ElectronicController::class, 'create'])->middleware('auth');

//Save electronic information

Route::post('/electronics/create', [ElectronicController::class, 'store'])->middleware('auth');

//edit electronic info

Route::get('/electronics/edit/{electronic}', [ElectronicController::class, 'edit'])->middleware('auth');

//save edited electronic info

Route::put('/electronics/edit/{electronic}', [ElectronicController::class, 'update']);

//display single electronic

Route::get('electronics/{electronic}', [ElectronicController::class, 'show']);

//delete electronic

Route::delete('/electronics/{electronic}', [ElectronicController::class, 'destroy'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

//main page for dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


///******Admin pages******///

//manage users

Route::get('/dashboard/manage/users', [DashboardController::class, 'manage_users'])->middleware('auth');

//manage electronics

Route::get('/dashboard/manage/electronics', [DashboardController::class, 'manage_electronics'])->middleware('auth');

//view hires

Route::get('/dashboard/view/hires', [DashboardController::class, 'manage_hires'])->middleware('auth');


///******User pages******///

//manage user electronics

Route::get('/dashboard/manage/user/electronics', [DashboardController::class, 'manage_user_electronics'])->middleware('auth');

//manage hired items

Route::get('/dashboard/manage/user/{user}/hires', [DashboardController::class, 'manage_user_hires'])->middleware('auth');



/*
|--------------------------------------------------------------------------
| Hire Requests Routes
|--------------------------------------------------------------------------
*/

//create request

Route::get('/hire/request/{electronic}', [HireRequestController::class, 'create'])->middleware('auth');

//save hire request info

Route::post('/request/{electronic}/create', [HireRequestController::class, 'store'])->middleware('auth');

//Manage user electronics

Route::get('/hire/requests/{user}', [HireRequestController::class, 'manage'])->middleware('auth');

//Accept hire request

Route::put('/hire/request/accept/{hireRequest}', [HireRequestController::class, 'accept'])->middleware('auth');

//Decline hire request

Route::put('/hire/request/decline/{hireRequest}', [HireRequestController::class, 'decline'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Hire Routes
|--------------------------------------------------------------------------
*/

//accept hire

Route::post('/hire/out', [HireController::class, 'store']);

//returned

Route::put('/hire/{hire}', [HireController::class, 'returned']);
