<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Livro extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'code', 
        'title', 
        'author', 
        'session_code',
    ];

}
