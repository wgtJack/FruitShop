<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 取得所有訂單
    public function index()
    {
        $orders = Order::with('items')->get();
        return response()->json($orders);
    }

    // 新增訂單
    public function store(Request $request)
    {
        // 驗證輸入數據
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'cart_items' => 'required|array',
            'cart_items.*.product_id' => 'required|exists:products,product_id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);

        // 計算總金額
        $totalAmount = 0;
        foreach ($validatedData['cart_items'] as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            $totalAmount += $product->price * $item['quantity'];
        }

        // 創建訂單
        $order = Order::create([
            'user_id' => $validatedData['user_id'],
            'total_amount' => $totalAmount,
            'order_status_id' => 1, // 預設狀態為 1
            'address' => $validatedData['address'],
        ]);

        // 新增訂單項目
        foreach ($validatedData['cart_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // 跳轉到首頁並帶回成功訊息
        return redirect()->route('front.home')->with('success', '訂單已成功建立！');
    }

    // 顯示特定訂單
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return response()->json($order);
    }

    // 更新訂單
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'total_amount' => 'nullable|numeric|min:0',
            'order_status_id' => 'nullable|exists:order_statuses,id',
            'address' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return response()->json($order);
    }

    // 刪除訂單
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully.']);
    }
}
