<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
}
