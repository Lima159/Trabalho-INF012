<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LivroController extends Controller
{
	public function index()
    {
    	$client = new Client();

        $response = $client->request('GET', 'http://localhost:7000/biblioteca/');
        //$response = $client->request('GET', 'google.com');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        //echo '<pre>'; print_r($body);
        //echo '<hr>';

        $newbody = json_decode($body, true);
        //echo '<pre>'; print_r($newbody[0]['code']); exit();

        return view('livro.get', compact('newbody'));
    }

    public function send()
    {
    	return view('livro.post');
    }


    public function post(Request $request)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); exit();

        $client = new Client();
        $response = $client->requestAsync('POST', 'http://localhost:7000/biblioteca/', [
            'form_params' => [
                'code' => '177',
                'title' => 'Vava',
                'author' => 'Fagner',
                'session_code' => '12',
            ]
        ]);
        echo '<pre>'; print_r($response);
        exit();
        /*
        $url = "http://localhost:7000/biblioteca/";

        $options = [
            'form_params' => [
                "code" => "1",
                "title" => "2",
                "author" => "3",
                "session_code" => "7",
            ]
        ]; 

        $request = $client->post($url, $options);
        echo '<pre>'; print_r($request); exit();
        */
/*
        $response = $client->request('GET', 'http://localhost:7000/biblioteca/');
        //$response = $client->request('GET', 'google.com');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        echo '<pre>'; print_r( $body ); exit;*/


/*
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:7000/biblioteca/', [
            'form_params' => [
                'code' => '1',
                'title' => '1',
                'author' => '1',
                'session_code' => '1',
            ]
        ]);


        $response = $response->getBody()->getContents();
        echo '<pre>';
        print_r($response);

        $client->post(
        'http://localhost:7000/biblioteca/',
        array(
                'form_params' => array(
                    'code' => "1",
                    'title' => "1",
                    'author' => "1",
                    'session_code' => "1"
                )
            )
        );

        //return view('someview', compact('post'));*/
    }
}
