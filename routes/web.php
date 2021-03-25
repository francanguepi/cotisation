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

//route de gestion des membres
Route::get('membres/listMember', 'MembresController@listMember');
Route::resource('membres', 'MembresController');
Route::get('/', 'MembresController@index');

//route de la cotisation
Route::post('cotisations/seanceCotisation', 'CotisationsController@enregistrerSeanceCotisation');
Route::post('cotisations/cotisation/afficherSeanceCotisation', 'CotisationsController@afficherSeanceCotisation');
Route::post('cotisations/reorganiserCotisation/calendrier/updateCalendrier', 'CotisationsController@updateCalendrier');

Route::get('cotisations/{id}', 'CotisationsController@afficherMembres');
Route::get('cotisations/{idCotisation}/calendrier', 'CotisationsController@afficherCalendrier');

Route::resource('cotisations', 'CotisationsController');


Auth::routes();
//Route::get('/', 'Auth\LoginController@showLoginForm');


//Route::get('/home', 'HomeController@index')->name('home');
