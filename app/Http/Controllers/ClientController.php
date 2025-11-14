<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class ClientController extends Controller
{
    public function index()
    {
        $categories = Category::with('menus')->get();
        return view('index.index', compact('categories'));
    }
}
