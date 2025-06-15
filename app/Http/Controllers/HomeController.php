<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = []; // TODO: Replace with actual data from database
        return view('home', compact('featuredProperties'));
    }
}
 