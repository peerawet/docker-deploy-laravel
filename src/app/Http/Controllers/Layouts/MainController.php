<?php

namespace App\Http\Controllers\Layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {

        return view('front-end.layouts.main');
    }

    public function about()
    {
        return view('front-end.layouts.about');
    }
}
