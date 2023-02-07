<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
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
//Route naming conventions to follow
//common Resource Routes for any project
//Index - Show all listings 
//show - Show single listing
//create - Show form to create new listing
//store - Store new listing
//edit - Show form to edit listing
//update - Update listing
//destroy - Delete listing


Route::get('/', [ListingController::class, 'index']);

Route::get('/details', function () {
    return view('details');
});

//////////////////////User Signup Routes//////////////////////////////

//show signup form
Route::get('/signup', [UserController::class, 'create']);

//create user
Route::post('/users', [UserController::class, 'store']);
// Show user dashboard
Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth');

Auth::routes([
    'verify' => TRUE,
]);

//show login form
Route::get('/signin', [UserController::class, 'login']);
Route::post('/userlogin', [UserController::class, 'authenticate']);

//log out
//Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/logout', [UserController::class,'logout']);

