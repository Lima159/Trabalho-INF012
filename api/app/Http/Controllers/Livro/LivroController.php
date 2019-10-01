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
        $validacao = \Validator::make($data,[
            "code" => "required",
            "title" => "required",
            "author" => "required",
            "session_code" => "required",
        ]);

        $client = new Client();
        

        $response = $client->post('http://localhost:7000/livros/', [
            'json' => [
                'code' => $data['code'],
                'title' => $data['title'],
                'author' => $data['author'],
                'session_code' => $data['session_code'],
            ]
        ]);

        return redirect()->back()->withErrors($validacao)->withInput();
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
        //echo '<pre>'; print_r($chosen); exit();

        return view('livro.put',compact('chosen'));
    }

    public function put(Request $request)
    {
        
        $data = $request->all();

        //echo 'http://localhost:7000/livros/'. $data['code'];
        //echo '<pre>'; print_r($data); exit();
        
        $validacao = \Validator::make($data,[
            "code" => "required",
            "title" => "required",
            "author" => "required",
            "session_code" => "required",
        ]);

        $client = new Client();
        $response = $client->put('http://localhost:7000/livros/'. $data['code']. '/', [
            'json' => [
                'code' => $data['code'],
                'title' => $data['title'],
                'author' => $data['author'],
                'session_code' => $data['session_code'],
            ]
        ]);

        return redirect()->back()->withErrors($validacao)->withInput();
    }

    public function confirm($data)
    {
        //echo '<pre>'; print_r($data); exit();
        return view('livro.delete',compact('data'));
    }

    public function delete($data)
    {
        //echo '<pre>'; print_r($data); exit();
        $client = new Client();
        $response = $client->delete('http://localhost:7000/livros/'. $data. '/', [
            'json' => $data,
        ]);

        return redirect()->back();
    }
}
