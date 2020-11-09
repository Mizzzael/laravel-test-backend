<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /*
    *@author: Mizael Silva Lemos
    */
    public function index()
    {

        return \view('main');

    }

}
