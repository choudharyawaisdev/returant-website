<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Size;
use App\Models\Addon;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->orderBy('created_at', 'desc')->get();
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

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menu_images'), $imageName);
            $imagePath = 'menu_images/' . $imageName;
        }

        DB::beginTransaction();
        try {
            $menuItem = Menu::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'discount' => $request->discount ?? 0,
                'image' => $imagePath,
            ]);

            $menuId = $menuItem->id;
            $createdPriceOptionsCount = 0;

            // Single price
            if (is_numeric($request->single_price)) {
                Size::create([
                    'menu_id' => $menuId,
                    'name' => 'Default',
                    'price' => $request->single_price,
                ]);
                $createdPriceOptionsCount++;
            }

            // Type-price rows
            $types = $request->input('type', []);
            $prices = $request->input('price', []);
            foreach ($types as $index => $type) {
                $price = $prices[$index] ?? null;
                if (!empty($type) && is_numeric($price)) {
                    Size::create([
                        'menu_id' => $menuId,
                        'name' => $type,
                        'price' => $price,
                    ]);
                    $createdPriceOptionsCount++;
                }
            }

            if ($createdPriceOptionsCount === 0) {
                throw new \Exception('At least one price field is required.');
            }

            // Save add-ons
            if ($request->has('addons')) {
                $menuItem->addons()->sync($request->addons);
            }

            DB::commit();
            return redirect()->route('admin.menus.index')->with('success', "Menu item created successfully with $createdPriceOptionsCount price option(s).");

        } catch (\Exception $e) {
            DB::rollBack();
            $errorMsg = $e->getMessage() === 'At least one price field is required.'
                ? ['single_price' => $e->getMessage()]
                : ['error' => 'An unexpected error occurred during creation.'];
            return redirect()->back()->withInput()->withErrors($errorMsg);
        }
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
