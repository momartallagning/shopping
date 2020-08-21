<?php

namespace App\Http\Controllers;

use App\Models\{ Product, Page };

class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::whereActive(true)->get();

        return view('home', compact('products'));
    }

    public function page(Page $page)
    {
        return view('page', compact('page'));
    }
}