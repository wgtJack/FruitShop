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
        $user = Auth::user();

        $orders = Order::where('user_id', $user->user_id)
            ->with('orderStatus')
            ->get();

        return view('front.orders.index', compact('orders'));
    }

    // 顯示訂單詳細
    public function show($id)
    {
        // 查詢訂單，確保訂單屬於該使用者
        $order = Order::where('user_id', Auth::user()->user_id)
            ->with(['orderStatus', 'orderItems.product'])  // 取得訂單狀態和訂單項目的商品資料
            ->findOrFail($id);  // 如果找不到訂單，會丟出 404 錯誤

        return view('front.orders.show', compact('order'));
    }

    // 新增訂單
    public function store(Request $request)
    {
        // 驗證表單資料
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'cart' => 'required|string',
        ]);

        // 解碼 JSON 資料
        $cart = json_decode($request->input('cart'), true);

        // 檢查購物車資料是否為有效陣列
        if (!is_array($cart) || empty($cart)) {
            return redirect()->back()->withErrors(['購物車為空或資料格式錯誤！']);
        }

        // 計算總金額
        $totalAmount = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // 創建訂單
        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'total_amount' => $totalAmount,
            'order_status_id' => 1,
            'address' => $validatedData['address'],
        ]);

        // 創建訂單項目
        $orderItems = [];
        foreach ($cart as $item) {
            $orderItems[] = [
                'order_id' => $order->order_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ];
        }

        // 使用 insert 批量插入訂單項目
        OrderItem::insert($orderItems);

        return redirect()->route('front.orders.index')->with('success', '訂單已創建成功！');
    }

    // 更新訂單
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // 更新訂單狀態
        $order->update([
            'order_status_id' => $request->input('order_status_id'),
        ]);

        return redirect()->route('front.orders.show', $id)
            ->with('success', '訂單已取消');
    }
}
