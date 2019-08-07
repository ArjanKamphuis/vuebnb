<?php

use App\Listing;
use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'ListingController@index_api');
Route::get('/saved', 'ListingController@index_api')->middleware('auth:api');
Route::get('/listing/{listing}', 'ListingController@show_api');
Route::patch('/user/toggle_saved', 'UserController@update_api')->middleware('auth:api');
