<?php

namespace App\Http\Controllers;

use App\Models\docs\enviados;
use App\Models\docs\recibidos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   
      
    
      return view('welcome');
    }

   
}
