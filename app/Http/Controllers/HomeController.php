<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController
{
    public function __invoke()
    {
        $categories = Category::published()->get();

        return view('home.index', compact('categories'));
    }
}