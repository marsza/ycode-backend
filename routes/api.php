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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('websites', 'WebsitesController@index');
Route::post('websites', 'WebsitesController@create');
Route::post('websites/update/{id}', 'WebsitesController@update');
// Search get Route
Route::post('websites/search/{id}', 'WebsitesController@filter');
Route::post('websites/search', 'WebsitesController@filter');

