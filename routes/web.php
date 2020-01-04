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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/acp', 'HomeController@acp')->name('acp');
Route::get('/acp/species', 'SpeciesController@index')->name('all-species');
Route::get('/acp/species/new', 'SpeciesController@create')->name('new-species');
Route::post('/acp/species/new', 'SpeciesController@save')->name('save-species');
