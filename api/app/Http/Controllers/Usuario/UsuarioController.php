<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:7000/usuarios/');
        //$response = $client->request('GET', 'google.com');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        //echo '<pre>'; print_r($body);
        //echo '<hr>';

        $newbody = json_decode($body, true);
        //echo '<pre>'; print_r($newbody[0]['code']); exit();

        return view('usuario.get', compact('newbody'));
    }

    public function send()
    {
        return view('usuario.post');
    }


    public function post(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "username" => "required",
            "password" => "required",
            "email" => "required",
            "user_registration" => "required",
            "adress" => "required",
            "tel" => "required",
        ]);

        $client = new Client();
        

        $response = $client->post('http://localhost:7000/usuarios/', [
            'json' => [
                'username' => $data['username'],
                'password' => $data['password'],
                'email' => $data['email'],
                'user_registration' => $data['user_registration'],
                'adress' => $data['adress'],
                'tel' => $data['tel'],
            ]
        ]);

        return redirect()->back()->withErrors($validacao)->withInput();
    }

    public function edit($data)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:7000/usuarios/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

        foreach($newbody as $key)
        {
            if($key['code'] == $data)
            {
                $chosen['username'] = $key['username'];
                $chosen['password'] = $key['password'];
                $chosen['email'] = $key['email'];
                $chosen['user_registration'] = $key['user_registration'];
                $chosen['adress'] = $key['adress'];
                $chosen['tel'] = $key['tel'];
            }
        }
        //echo '<pre>'; print_r($chosen); exit();

        return view('usuario.put',compact('chosen'));
    }

    public function put(Request $request)
    {
        
        $data = $request->all();

        //echo '<pre>'; print_r($data); exit();
        /*
        $validacao = \Validator::make($data,[
            "code" => "required",
            "title" => "required",
            "author" => "required",
            "session_code" => "required",
        ]);*/

        $response = $client->put('http://localhost:7000/usuarios/', [
            'json' => [
                'username' => $data['username'],
                'password' => $data['password'],
                'email' => $data['email'],
                'user_registration' => $data['user_registration'],
                'adress' => $data['adress'],
                'tel' => $data['tel'],
            ]
        ]);

        //return redirect()->back()->withErrors($validacao)->withInput();
    }
}
