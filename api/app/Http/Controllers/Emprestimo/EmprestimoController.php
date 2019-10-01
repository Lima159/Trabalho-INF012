<?php

namespace App\Http\Controllers\Emprestimo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class EmprestimoController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->request('GET', 'http://localhost:7000/emprestimos/');
        //$response = $client->request('GET', 'google.com');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        //echo '<pre>'; print_r($body);
        //echo '<hr>';

        $newbody = json_decode($body, true);
        //echo '<pre>'; print_r($newbody[0]['code']); exit();

        return view('emprestimo.get', compact('newbody'));
    }

    public function send()
    {
        return view('emprestimo.post');
    }


    public function post(Request $request)
    {
        $data = $request->all();
        //$data['date_time'] = 
        /*echo '<pre>';
        print_r($data['date_time']);
        exit();
*/
        $validacao = \Validator::make($data,[
            "code" => "required",
            "date_time" => "required",
            "devolution_date" => "required",
            "user_registration" => "required", //botar só números
        ]);

        $client = new Client();
        

        $response = $client->post('http://localhost:7000/emprestimos/', [
            'json' => [
                'code' => $data['code'],
                'date_time' => $data['date_time'],
                'devolution_date' => $data['devolution_date'],
                'user_registration' => $data['user_registration'],
            ]
        ]);

        return redirect()->back()->withErrors($validacao)->withInput();
    }

    public function edit($data)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:7000/emprestimos/');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $newbody = json_decode($body, true);

        foreach($newbody as $key)
        {
            if($key['code'] == $data)
            {
                $chosen['code'] = $key['code'];
                $chosen['date_time'] = $key['date_time'];
                $chosen['devolution_date'] = $key['devolution_date'];
                $chosen['user_registration'] = $key['user_registration'];
            }
        }
        //echo '<pre>'; print_r($chosen); exit();

        return view('emprestimo.put',compact('chosen'));
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

        $response = $client->put('http://localhost:7000/emprestimos/', [
            'json' => [
                'code' => $data['code'],
                'date_time' => $data['date_time'],
                'devolution_date' => $data['devolution_date'],
                'user_registration' => $data['user_registration'],
            ]
        ]);

        //return redirect()->back()->withErrors($validacao)->withInput();
    }
}
