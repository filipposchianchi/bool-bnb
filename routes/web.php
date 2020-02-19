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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@userApartments')->name('user') ->middleware('auth');
Route::get('/apartment/{id}', 'HomeController@showApartments')->name('apartmentShow');

Route::get('/apartment/edit/{id}', 'HomeController@editApartment')->name('apartment.edit');
Route::post('/apartment/update/{id}', 'HomeController@updateApartment')->name('apartment.update');

Route::post('/apartments/store/', 'HomeController@storeApartments')->name('apartment.store');
Route::get('/apartments/create/', 'HomeController@createApartment')->name('apartment.create')->middleware('auth');

Route::get('/apartments/delete/{id}', 'HomeController@deleteApartment')->name('apartment.delete');


Route::get('/apartments/test/{id}', 'HomeController@searchAddress')->name('apartment.test');

// search route rf3
Route::post('/search-apartment', 'HomeController@searchRadiusApartment')->name('apartment.search');


// auto complete
Route::post('/autocomplete/fetch', 'TomtomController@fetch')->name('autocomplete.fetch');




Route::post('/message/store/apartment{id}', 'HomeController@storeMessage')->name('message.store');
