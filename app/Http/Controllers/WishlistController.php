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
        if (!Auth::check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $userId = Auth::id();
        $menuId = $request->menu_id;

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('menu_id', $menuId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'menu_id' => $menuId
            ]);
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'menu_id' => $menuId
        ]);
    }
}
