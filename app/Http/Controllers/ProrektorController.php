<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProrektorController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
}
