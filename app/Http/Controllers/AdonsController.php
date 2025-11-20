<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addon;
use App\Models\Menu;

class AdonsController extends Controller
{
    public function index()
    {
        $adons = Addon::with('menu')->get(); // Fix: Fetch Addons, not menus
        $menus = Menu::all(); // Needed for modal dropdown
        return view('admin.adons.index', compact('adons', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Addon::create([
            'menu_id' => $request->menu_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.adons.index')->with('success', 'Add-on created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $adon = Addon::findOrFail($id);
        $adon->update([
            'menu_id' => $request->menu_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.adons.index')->with('success', 'Add-on updated successfully.');
    }

    public function destroy(string $id)
    {
        $adon = Addon::findOrFail($id);
        $adon->delete();

        return redirect()->route('admin.adons.index')->with('success', 'Add-on deleted successfully.');
    }
}
