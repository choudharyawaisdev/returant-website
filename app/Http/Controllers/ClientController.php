<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Stevebauman\Location\Facades\Location;

class ClientController extends Controller
{
   public function index(Request $request)
{
    // Get search query
    $searchQuery = $request->input('q');

    // Filter categories + items
    $categories = Category::with(['menus' => function ($query) use ($searchQuery) {
        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }
    }])->get();

    return view('index.index', compact('categories', 'searchQuery'));
}


    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }
}
