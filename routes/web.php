<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('login');
});
Route::get('/register/index','RegisterController@index');
Route::post('/register','RegisterController@register');
Route::get('/register/username/{query}','RegisterController@checkUsername');
Route::get('/register/email/{query}','RegisterController@checkEmail');
Route::get('/register/cellulare/{query}','RegisterController@checkCellulare');
Route::get('/','LoginController@login');
Route::post('/login','LoginController@checkLogin');
Route::get('/logout','LoginController@logout');
Route::get('/carica', 'CaricaController@carica');
Route::get('/carica/home', 'CaricaController@home');
Route::get('/descrizione', 'CaricaController@descrizione');
Route::get('/home', 'HomeController@index');
Route::post('/SalvaDescrizione', 'HomeController@store');
Route::get('/preferito/verifica/{preferito}/{id}','PreferitoController@verifica');
Route::get('/preferito/modifica/{preferito}/{id}','PreferitoController@modifica');
Route::get('/creazione/carica/{query}','CreazioneController@carica');
Route::get('/creazione/cancella/{id}','CreazioneController@cancella');
Route::post('/logged','CreazioneController@invia');
Route::get('/ricerca/{query}', 'RicercaController@ricetta');
Route::get('/ricercaSpotify', 'RicercaController@spotify');
Route::get('/ricerca/utente/{query}', 'RicercaController@utente');


