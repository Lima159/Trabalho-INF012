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
Route::get('json-get', 'LivroController@index');
/*
Route::get('/json-get', function() {
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
});*/

Route::get('/json-post','LivroController@send');
Route::post('/json-post/post','LivroController@post');
// https://stackoverflow.com/questions/22244738/how-can-i-use-guzzle-to-send-a-post-request-in-json
// https://stackoverflow.com/questions/27825667/php-guzzlehttp-how-to-make-a-post-request-with-params
//Route::post('/json-post', function(){});

// Route::put('/json-put', function(){});
// https://stackoverflow.com/questions/25554302/guzzle-how-to-send-put-request-in-laravel


// Route::delete('/json-delete', function(){});
// https://stackoverflow.com/questions/32831928/delete-request-with-parameters-using-guzzle
