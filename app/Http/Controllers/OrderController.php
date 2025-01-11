<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 顯示使用者的所有訂單
    public function index()
    {
        // 獲取當前登入的使用者 ID
        $userId = Auth::id();

        // 根據使用者 ID 查詢訂單
        $orders = Order::where('user_id', $userId)->get();

        // 返回訂單列表視圖，並傳遞訂單資料
        return view('front.orders.index', compact('orders'));
    }

    // 顯示單一訂單的詳細資訊
    public function show($orderId)
    {
        // 獲取當前登入的使用者 ID
        $userId = Auth::id();

        // 查詢該使用者的指定訂單
        $order = Order::where('id', $orderId)
            ->where('user_id', $userId)
            ->firstOrFail();

        // 返回訂單詳細視圖
        return view('front.orders.show', compact('order'));
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
