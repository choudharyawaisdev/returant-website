<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addon;
use App\Models\Menu;

class AdonsController extends Controller
{
    public function index()
    {
        $adons = Addon::with('menu')->get();
        return view('admin.addons.index', compact('adons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Addon::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.addons.index')->with('success', 'Add-on created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $adon = Addon::findOrFail($id);
        $adon->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.addons.index')->with('success', 'Add-on updated successfully.');
    }

    public function destroy(string $id)
    {
        $adon = Addon::findOrFail($id);
        $adon->delete();

        return redirect()->route('admin.addons.index')->with('success', 'Add-on deleted successfully.');
    }
}
