<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('menu', 'App\Http\Controllers\crudController@menu');
Route::get('datatable', 'App\Http\Controllers\crudController@index');
Route::get('edit/{id}/edit', 'App\Http\Controllers\crudController@edit');
Route::post('store', 'App\Http\Controllers\crudController@store');
Route::delete('delete/{id}', 'App\Http\Controllers\crudController@destroy');

