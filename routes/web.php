<?php

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
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/get-username', 'HomeController@getUsername');
    Route::get('/get-all-cost-directions', 'CostDirectionsController@getCostDirections');
    Route::post('/add-cost-direction', 'CostDirectionsController@createCostDirection');
});


// vue router
Route::get('/{vue_capture?}', function () {
    return view("admin");
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');