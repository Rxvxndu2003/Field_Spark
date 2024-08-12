<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function index1()
    {
        return view('auth.register');
    }
    public function index2()
    {
        return view('pages.dashboard');
    }
    public function index3()
    {
        return view('pages.home');
    }
    public function index4()
    {
        return view('pages.aboutus');
    }
    public function index5()
    {
        return view('pages.services');
    }
    public function index6()
    {
        return view('pages.plants');
    }
    public function index7()
    {
        return view('pages.contactus');
    }

    public function index8()
    {
        return view('pages.instructors');
    }
    
}
