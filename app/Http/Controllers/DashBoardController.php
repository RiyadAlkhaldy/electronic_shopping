<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashBoardController extends Controller
{
    public function index()
    {
//        date_default_timezone_set("Asia/Sana\'a");

//        return   date("Y-D-M    h:m");
        return view('dashboard.index');
    }
}
