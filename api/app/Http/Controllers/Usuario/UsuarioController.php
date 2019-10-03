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
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

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

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

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

        return redirect()->back();
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
            if($key['user_registration'] == $data)
            {
                $chosen['username'] = $key['username'];
                $chosen['password'] = $key['password'];
                $chosen['email'] = $key['email'];
                $chosen['user_registration'] = $key['user_registration'];
                $chosen['adress'] = $key['adress'];
                $chosen['tel'] = $key['tel'];
            }
        }
        return view('usuario.put',compact('chosen'));
    }

    public function put(Request $request)
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

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $client = new Client();
        $response = $client->put('http://localhost:7000/usuarios/'. $data['user_registration']. '/', [
            'json' => [
                'username' => $data['username'],
                'password' => $data['password'],
                'email' => $data['email'],
                'user_registration' => $data['user_registration'],
                'adress' => $data['adress'],
                'tel' => $data['tel'],
            ]
        ]);
        return redirect()->back();
    }

    public function delete($data)
    {
        $client = new Client();
        $response = $client->delete('http://localhost:7000/usuarios/'. $data. '/', [
            'json' => $data,
        ]);

        return redirect()->back();
    }
}
