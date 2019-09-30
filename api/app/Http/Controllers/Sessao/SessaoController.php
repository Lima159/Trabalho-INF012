<?php

namespace App\Http\Controllers\Sessao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class SessaoController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:7000/sessoes/');
        //$response = $client->request('GET', 'google.com');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        //echo '<pre>'; print_r($body);
        //echo '<hr>';

        $newbody = json_decode($body, true);
        //echo '<pre>'; print_r($newbody[0]['code']); exit();

        return view('sessao.get', compact('newbody'));
    }

    public function send()
    {
        return view('sessao.post');
    }


    public function post(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "code" => "required",
            "details" => "required",
            "location" => "required",
        ]);

        $client = new Client();
        

        $response = $client->post('http://localhost:7000/sessoes/', [
            'json' => [
                'code' => $data['code'],
                'details' => $data['details'],
                'location' => $data['location'],
            ]
        ]);

        return redirect()->back()->withErrors($validacao)->withInput();
    }

    public function edit($data)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:7000/sessoes/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

        foreach($newbody as $key)
        {
            if($key['code'] == $data)
            {
                $chosen['code'] = $key['code'];
                $chosen['details'] = $key['details'];
                $chosen['location'] = $key['location'];
            }
        }
        //echo '<pre>'; print_r($chosen); exit();

        return view('sessao.put',compact('chosen'));
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

        $response = $client->put('http://localhost:7000/sessoes/', [
            'json' => [
                'code' => $data['code'],
                'details' => $data['details'],
                'location' => $data['location'],
            ]
        ]);

        //return redirect()->back()->withErrors($validacao)->withInput();
    }
}
