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

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('json-api', 'ApiController@index');
Route::get('/json-api', function() {
	$client = new Client();

	$response = $client->request('GET', 'https://localhost:8000/biblioteca');
	$statusCode = $response->getStatusCode();
	$body = $response->getBody()->getContents();

	return $body;
});