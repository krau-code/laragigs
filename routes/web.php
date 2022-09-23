<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// --------------------------------------------------------------------------
// LISTING

// Get All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Listing Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing Data
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing Data
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Find Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// --------------------------------------------------------------------------
// USER

// Show Register/Create User Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// --------------------------------------------------------------------------
// *** For Reference ***

Route::get('/hello', function() {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo','bar');
});

Route::get('posts/{id}', function($id) { // "{ }" Wildcard
    // dd($id); // die and dump
    // ddd($id); // die dump debug
    return response('Post '. $id);
})->where('id', '[0-9]+'); // condition to accept just numbers

Route::get('/search', function(Request $request) { // right-click "request", and then choose "import class"
    return $request->name . ' ' . $request->city;
});

// *** End - For Reference ***