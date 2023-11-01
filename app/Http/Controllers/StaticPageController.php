<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function home()
    {
        return view('static.home');
    }

    public function privacy()
    {
        return view('static.privacy');

    }
    public function terms()
    {
        return view('static.terms');

    }
    public function contact()
    {
        return view('static.contact');

    }
    public function colours()
    {
        return view('static.colours');

    }
    public function icons()
    {
        return view('static.icons');

    }
}
