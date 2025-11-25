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
        // 1️⃣ Fetch search query
        $searchQuery = $request->input('q');

        // 2️⃣ Fetch categories with optional search
        $categories = Category::with(['menus' => function ($query) use ($searchQuery) {
            if ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            }
        }])->get();

        // 3️⃣ Fetch user location
        $position = Location::get();
        $city = $position->cityName ?? 'Chiniot';
        if ($city !== 'Chiniot') {
            $city = 'Chiniot';
        }

        // All areas in Chiniot
        $chinotAreas = [
            'Bhikhi', 'Khatwan', 'Chiniot City', 'Jhang Road', 'Lalian', 'Bhawana'
        ];

        return view('index.index', compact('categories', 'searchQuery', 'city', 'chinotAreas'));
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }
}
