<?php
use GuzzleHttp\Client;

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

Route::get('/home', 'HomeController@index');

Route::middleware(['auth'])->prefix('livro')->namespace('livro')->group(function(){
	Route::get('/get', 'LivroController@index');
	Route::get('/post','LivroController@send');
	Route::post('/post/post','LivroController@post');
	Route::get('/edit/{code}','LivroController@edit');
	Route::post('/edit/put','LivroController@put');
});

Route::middleware(['auth'])->prefix('sessao')->namespace('sessao')->group(function(){
	Route::get('/get', 'SessaoController@index');
	Route::get('/post','SessaoController@send');
	Route::post('/post/post','SessaoController@post');
	Route::get('/edit/{code}','SessaoController@edit');
	Route::post('/edit/put','SessaoController@put');
});

Route::middleware(['auth'])->prefix('emprestimo')->namespace('emprestimo')->group(function(){
	Route::get('/get', 'EmprestimoController@index');
	Route::get('/post','EmprestimoController@send');
	Route::post('/post/post','EmprestimoController@post');
	Route::get('/edit/{code}','EmprestimoController@edit');
	Route::post('/edit/put','EmprestimoController@put');
});

Route::middleware(['auth'])->prefix('usuario')->namespace('usuario')->group(function(){
	Route::get('/get', 'UsuarioController@index');
	Route::get('/post','UsuarioController@send');
	Route::post('/post/post','UsuarioController@post');
	Route::get('/edit/{code}','UsuarioController@edit');
	Route::post('/edit/put','UsuarioController@put');
});

// Route::put('/json-put', function(){});
// https://stackoverflow.com/questions/25554302/guzzle-how-to-send-put-request-in-laravel


// Route::delete('/json-delete', function(){});
// https://stackoverflow.com/questions/32831928/delete-request-with-parameters-using-guzzle
