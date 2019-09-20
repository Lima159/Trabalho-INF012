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
//Route::get('json-api', 'ApiController@index');
Route::get('/json-api', function() {
	$client = new Client();

	$response = $client->request('GET', 'http://localhost:7000/biblioteca/');
	//$response = $client->request('GET', 'google.com');
	$statusCode = $response->getStatusCode();
	$body = $response->getBody()->getContents();

	//echo '<pre>'; print_r($body);
	//echo '<hr>';

	$newbody = json_decode($body, true);
	//echo '<pre>'; print_r($newbody[0]['code']); exit();

	return view('test', compact('newbody'));
	//return $body;
});