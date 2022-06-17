<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

//All Listing
Route::get('/', [ListingController::class, 'index'])->name('listings.index');
Route::get('/man', [ListingController::class, 'index'])->name('listings.manage');

//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth')->name('listings.create');

//Store Listing Data
Route::post('/listings/', [ListingController::class, 'store'])->middleware('auth')->name('listings.store');

//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth')->name('listings.edit');

//Edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth')->name('listings.update');

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

//Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth')->name('listings.delete');


//Show register create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('users.register');

//Create new user
Route::post('/users', [UserController::class, 'store'])->name('users.create');

//Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('users.logout');

//Show login form
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('users.login');

//Login the user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest')->name('users.authenticate');


//Route::get('/hello', function (){
//    return 'Hello World';
//});
//
//Route::get('search', function(Request $request){
////    dd($request->name . ' ' . $request->city); debug and die
//    return response($request->name . ' ' . $request->city, 200);
//});
