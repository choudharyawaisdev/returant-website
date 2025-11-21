<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuSize;
use App\Models\Addon;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        $addons = Addon::all();
        return view('admin.menus.create', compact('categories', 'addons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image',
            'single_price' => 'nullable|numeric|min:0',
            'type' => 'nullable|array',
            'type.*' => 'nullable|string|max:100',
            'price' => 'nullable|array',
            'price.*' => 'nullable|numeric|min:0',
            'addons' => 'nullable|array',
            'addons.*' => 'nullable|exists:addons,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menu_images'), $imageName);
            $imagePath = 'menu_images/' . $imageName;
        }

        $createdPriceOptionsCount = 0;

        DB::transaction(function () use ($request, $imagePath, &$createdPriceOptionsCount) {

            $firstPrice = null;

            if (is_numeric($request->single_price)) {
                $firstPrice = $request->single_price;
            } else {
                $prices = $request->input('price', []);
                if (!empty($prices[0]) && is_numeric($prices[0])) {
                    $firstPrice = $prices[0];
                }
            }

            if (!is_numeric($firstPrice)) {
                abort(422, "At least one price is required.");
            }

            $menuItem = Menu::create([
                'category_id' => $request->category_id,
                'title'       => $request->title,
                'description' => $request->description,
                'discount'    => $request->discount ?? 0,
                'image'       => $imagePath,
                'price'       => $firstPrice,
            ]);

            $menuId = $menuItem->id;

            $types  = $request->input('type', []);
            $prices = $request->input('price', []);

            foreach ($types as $index => $type) {
                $price = $prices[$index] ?? null;

                if (!empty($type) && is_numeric($price)) {
                    MenuSize::create([
                        'menu_id' => $menuId,
                        'name'    => $type,
                        'price'   => $price,
                    ]);
                    $createdPriceOptionsCount++;
                }
            }

            if ($request->has('addons')) {
                foreach ($request->addons as $addonId) {
                    DB::table('menu_addon')->insert([
                        'menu_id' => $menuId,
                        'addon_id' => $addonId,
                    ]);
                }
            }

        });

        return redirect()->route('admin.menus.create')
            ->with('success', "Menu created successfully with $createdPriceOptionsCount price option(s).");
    }



    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|lte:price',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $menu->image;

        if ($request->hasFile('image')) {
            if ($menu->image && File::exists(public_path($menu->image))) {
                File::delete(public_path($menu->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menu_images'), $imageName);
            $imagePath = 'menu_images/' . $imageName;
        }

        $menu->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->image && File::exists(public_path($menu->image))) {
            File::delete(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }
}
