<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function admin()
    { 
        $categories = Category::all();
        return view('categories.indexC',compact('categories')); 
    }
    public function buyer()
    { 
        $categories = Category::all();
        return view('categories.indexC',compact('categories')); 
    }
    public function seller()
    { 
        $categories = Category::all();
        return view('categories.indexC',compact('categories')); 
    }

}
