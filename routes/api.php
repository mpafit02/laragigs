<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     // We need to return json since we are creating an API
//     return 'This is the API';
// });

// Route::get('/posts', function () {
//     // We need to return json since we are creating an API
//     return response()->json([
//         'posts' => [
//             [
//                 'title' => 'Post one'
//             ]
//         ]
//     ]);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
