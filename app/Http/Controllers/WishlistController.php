<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'menu_id' => $request->menu_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Added to wishlist'
        ]);
    }

     public function toggle(Request $request)
    {
        $userId = auth()->id();
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
