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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/NewCharacter', 'characterController@create')->name('new-character')->middleware('auth');
Route::post('/NewCharacter', 'characterController@save')->name('save-character')->middleware('auth');
Route::get('/acp/characters', 'characterController@index')->name('all-characters')->middleware('auth');
Route::get('/acp/character/{id}', 'characterController@show')->name('character')->middleware('auth');

Route::get('/acp', 'HomeController@acp')->name('acp')->middleware('auth');
Route::get('/acp/species', 'SpeciesController@index')->name('all-species');
Route::get('/acp/species/new', 'SpeciesController@create')->name('new-species');
Route::post('/acp/species/new', 'SpeciesController@save')->name('save-species');
Route::get('/acp/species/{id}', 'SpeciesController@show')->name('species');
Route::get('/acp/species/{id}/edit', 'SpeciesController@edit')->name('edit-species');
Route::post('/acp/species/{id}/edit', 'SpeciesController@update')->name('update-species');

Route::get('/acp/users', 'UserController@index')->name('all-users')->middleware('auth');
Route::get('/profile/{id?}', 'UserController@show')->name('user')->middleware('auth');
Route::get('/profile/{id}/edit', 'UserController@edit')->name('edit-user')->middleware('auth');
Route::post('/profile/{id}/edit', 'UserController@update')->name('update-user')->middleware('auth');

Route::get('/acp/roles', 'RoleController@index')->name('all-roles');
Route::get('/acp/role/{id}', 'RoleController@show')->name('role');
Route::get('/acp/role/{id}/edit', 'RoleController@edit')->name('edit-role');
Route::post('/acp/role/{id}/edit', 'RoleController@update')->name('update-role');
Route::get('/acp/newRole', 'RoleController@create')->name('new-role');
Route::post('/acp/newRole', 'RoleController@store')->name('save-role');

Route::post('/acp/user/{id}/addRole', 'UserController@addRole')->name('add-user-role');
Route::get('/acp/user/{user}/delRole/{role}', 'UserController@removeRole')->name('remove-user-role');

Route::get('/acp/map', 'LocationController@index')->name('locations')->middleware('auth');
Route::get('/acp/systems', 'SystemController@index')->name('all-systems')->middleware('auth');
Route::get('/acp/system/{id}', 'SystemController@show')->name('acp-system')->middleware('auth');
Route::get('/acp/system/{id}/edit', 'SystemController@edit')->name('edit-system')->middleware('auth');
Route::post('/acp/system/{id}/edit', 'SystemController@update')->name('update-system')->middleware('auth');

Route::get('/acp/stars', 'StarTypeController@index')->name('all-star-types')->middleware('auth');
Route::get('/acp/star/new', 'StarTypeController@create')->name('create-star-type')->middleware('auth');
Route::post('/acp/star/new', 'StarTypeController@store')->name('store-star-type')->middleware('auth');
Route::get('/acp/star/{id}', 'StarTypeController@show')->name('acp-star-type')->middleware('auth');
Route::get('/acp/star/{id}/edit', 'StarTypeController@edit')->name('edit-star-type')->middleware('auth');
Route::post('/acp/star/{id}/edit', 'StarTypeController@update')->name('update-star-type')->middleware('auth');
