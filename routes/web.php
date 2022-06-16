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

//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');

//Store Listing Data
Route::post('/listings/', [ListingController::class, 'store'])->name('listings.store');

//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');

//Edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

//Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.delete');


//Show register create form
Route::get('/register', [UserController::class, 'create'])->name('users.register');

//Create new user
Route::post('/users', [UserController::class, 'store'])->name('users.create');

Route::get('/login', [UserController::class, 'create'])->name('users.login');


//Route::get('/hello', function (){
//    return 'Hello World';
//});
//
//Route::get('search', function(Request $request){
////    dd($request->name . ' ' . $request->city); debug and die
//    return response($request->name . ' ' . $request->city, 200);
//});
