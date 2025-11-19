<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        $categories = Category::with(['menus' => function ($query) use ($searchQuery) {
            if ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
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
