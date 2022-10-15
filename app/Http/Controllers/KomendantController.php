<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KomendantController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
}
