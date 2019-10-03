<?php

namespace App\Http\Controllers\Livro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class LivroController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:7000/livros/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

        return view('livro.get', compact('newbody'));
    }

    public function send()
    {
        return view('livro.post');
    }


    public function post(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "code" => "required",
            "title" => "required",
            "author" => "required",
            "session_code" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $client = new Client();
        
        $response = $client->post('http://localhost:7000/livros/', [
            'json' => [
                'code' => $data['code'],
                'title' => $data['title'],
                'author' => $data['author'],
                'session_code' => $data['session_code'],
            ]
        ]);

        return redirect()->back();
    }

    public function edit($data)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:7000/livros/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

        foreach($newbody as $key)
        {
            if($key['code'] == $data)
            {
                $chosen['code'] = $key['code'];
                $chosen['title'] = $key['title'];
                $chosen['author'] = $key['author'];
                $chosen['session_code'] = $key['session_code'];
            }
        }
        return view('livro.put',compact('chosen'));
    }

    public function put(Request $request)
    {        
        $data = $request->all();        
        $validacao = \Validator::make($data,[
            "code" => "required",
            "title" => "required",
            "author" => "required",
            "session_code" => "required",
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $client = new Client();
        $response = $client->put('http://localhost:7000/livros/'. $data['code']. '/', [
            'json' => [
                'code' => $data['code'],
                'title' => $data['title'],
                'author' => $data['author'],
                'session_code' => $data['session_code'],
            ]
        ]);
        return redirect()->back();
    }

    public function delete($data)
    {
        $client = new Client();
        $response = $client->delete('http://localhost:7000/livros/'. $data. '/', [
            'json' => $data,
        ]);

        return redirect()->back();
    }
}
