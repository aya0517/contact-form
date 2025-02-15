<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        $categories = Category::all();

        return view('contact', compact('categories'));
    }
}
