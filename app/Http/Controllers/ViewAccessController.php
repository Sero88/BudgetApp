<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewAccessController extends Controller
{

    public function __construct(){
        $this->middleware('access.key', ['only' => ['index']]);
    }

    public function index(){
        return redirect('/')->cookie('access_key', config('app.access_key'), 525600 );
    }
}
