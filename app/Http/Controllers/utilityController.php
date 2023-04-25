<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class utilityController extends Controller
{
    //


    function logout()
    {
        session()->flush();
        return redirect('login');
    }
}
