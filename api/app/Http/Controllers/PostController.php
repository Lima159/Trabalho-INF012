<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
	public function index()
    {
    	
    	return view('livro.post');
    }
/*
    public function show($id)
    {
    	$client = new \GuzzleHttp\Client();
        $client->post(
        'http://localhost:7000/biblioteca/',
        array(
                'form_params' => array(
                    'code' => 'test@gmail.com',
                    'title' => 'Test user',
                    'author' => 'testpassword'
                    'session_code' => 'testpassword'
                )
            )
        );

    	return view('someview', compact('post'));
    }*/
}
