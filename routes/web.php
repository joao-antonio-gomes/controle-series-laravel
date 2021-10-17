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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('auth');
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('auth');
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('auth');
Route::get('/series/{id}/temporadas', 'TemporadasController@index');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('auth');
Route::get('/series/{serie}/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/series/{serie}/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index')->name('entrar');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});
