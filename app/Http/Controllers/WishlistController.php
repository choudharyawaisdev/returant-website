<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function menu()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlists = Wishlist::with('menu')
            ->where('user_id', Auth::id())
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

      public function toggle(Request $request)
    {
        $menuId = $request->menu_id;
        $userId = auth()->id();

        // Check if already in wishlist
        $exist = Wishlist::where('user_id', $userId)
                         ->where('menu_id', $menuId)
                         ->first();

        if ($exist) {
            $exist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'menu_id' => $menuId
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
