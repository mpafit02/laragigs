<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

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


// These is a route, it uses the "Route" class and its method "get" (it coulde be any http request e.g. "post", "put", "delete")
// In a get request to "/" we return the view welcome (welcome.blade.php, which is located in ./resources/views/)
// All Listings route calls the all listings controller (index)
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Single Listing route without id - IMPORTANT: This row should be bellow the listings/create since we start from more specific to more generic
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post("/logout", [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


// // Single Listing route with id
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if ($listing) {
//         // In case the listing exists
//         return view('listing', [
//             'listing' => Listing::find($id) // Find the listing with this id from the model
//         ]);
//     } else {
//         // In case the listing doesn't exists
//         abort('404');
//     }
// });

// // Return directly a string when calling the url: laragigs.test/hello
// Route::get('/hello', function () {
//     return 'Hello World';
// });

// // Return a response object instead of just a string when calling the url: laragigs.test/hello/object
// Route::get('/hello/object', function () {
//     // We can return a status code as well by saying: response('Hello World', 400), the deafult status code is 200
//     return response('<h1>Hello World</h1>')
//         ->header('Content-Type', "text/plain")
//         ->header('foo', "bar"); // add a custom headre named foo with value bar.
// });

// // Return a response which contains the id from the url
// Route::get('/posts/{id}', function ($id) {
//     return response('Post ' . $id);
// });

// // Return a response which contains the id from the url and add a constraing to return only positive numbers
// Route::get('/posts/positive/{id}', function ($id) {
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/posts/dd/{id}', function ($id) {
//     // use a helper method for debugging to show the id (status code will be 500)
//     dd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/posts/ddd/{id}', function ($id) {
//     // use a helper method for debugging to show  a full detailed report about this breakpoint (status code will be 500)
//     ddd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// // Access arguments passed in the url e.g., /search?name=Test&city=Boston
// Route::get('/search', function (Request $request) {
//     return $request->name . ' ' . $request->city;
// });