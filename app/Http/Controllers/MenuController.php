<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuSize;
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
        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'single_price' => 'nullable|numeric|min:0',
            'type' => 'nullable|array', 
            'type.*' => 'nullable|string|max:100',
            'price' => 'nullable|array', 
            'price.*' => 'nullable|numeric|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menu_images'), $imageName);
            $imagePath = 'menu_images/' . $imageName;
        }

        $discount = $request->input('discount') ?? 0;
        $createdPriceOptionsCount = 0;
        
        DB::beginTransaction();
        try {
            $menuItem = Menu::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'discount' => $discount,
                'image' => $imagePath,
                'price' => 0,
                'type' => null, 
            ]);

            $menuId = $menuItem->id;

            if (is_numeric($request->single_price)) {
                MenuSize::create([
                    'menu_id' => $menuId,
                    'name' => 'Default',
                    'price' => $request->single_price,
                ]);
                $createdPriceOptionsCount++;
            }
            
            $types = $request->input('type', []);
            $prices = $request->input('price', []);
            
            foreach ($types as $index => $type) {
                $price = $prices[$index] ?? null;

                if (!empty($type) && is_numeric($price)) {
                    MenuSize::create([
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

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getMessage() === 'At least one price field is required.') {
                 return redirect()->back()->withInput()->withErrors(['single_price' => $e->getMessage()]);
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'An unexpected error occurred during creation.']);
        }

        return redirect()->route('admin.menus.index')->with('success', "Menu item created successfully with $createdPriceOptionsCount price option(s).");
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
