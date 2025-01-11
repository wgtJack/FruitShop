<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // 顯示所有產品頁面 (前台首頁)
    public function index()
    {
        $products = Product::all(); // 獲取所有產品
        return view('front.products.index', compact('products')); // 傳遞資料給視圖
    }

    // 顯示單一產品頁面 (前台)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('front.products.show', compact('product'));
    }

    // 顯示所有產品頁面 (後台首頁)
    public function adminIndex()
    {
        $products = Product::all(); // 獲取所有產品
        return view('admin.products.index', compact('products'));
    }

    // 顯示新增產品頁面 (後台)
    public function create()
    {
        return view('admin.products.create');
    }

    // 顯示編輯產品頁面 (後台).
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // 儲存新產品
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', // 圖片驗證
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
        ]);

        // 上傳圖片並儲存圖片路徑
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public'); // 儲存在 storage/app/public/products
        }

        // 新增產品資料
        $validated['image_path'] = $imagePath;  // 設定儲存的圖片路徑

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', '產品新增成功！');
    }

    // 更新產品
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // 允許圖片為空
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        // 如果有上傳新圖片
        if ($request->hasFile('image')) {
            // 刪除舊圖片
            if (Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }

            // 上傳新圖片並儲存圖片路徑
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $imagePath;  // 設定新的圖片路徑
        }

        // 更新產品資料
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', '產品更新成功！');
    }

    // 刪除產品
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 刪除圖片檔案
        if (Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // 刪除產品資料
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', '產品刪除成功！');
    }
}
