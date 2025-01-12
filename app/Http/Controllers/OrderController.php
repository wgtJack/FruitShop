<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    // 後台顯示所有訂單，並載入每個訂單的使用者資訊
    public function adminIndex()
    {
        // 撈取所有訂單，並同時載入使用者資料
        $orders = Order::with('user', 'orderStatus')->get();

        // 傳遞訂單資料到視圖
        return view('admin.orders.index', compact('orders'));
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

    // 後台 show 方法
    public function adminshow($id)
    {
        $order = Order::with('user', 'orderStatus')->findOrFail($id);
        $orderStatuses = DB::table('order_statuses')->pluck('status_name', 'order_status_id'); // 獲取所有訂單狀態

        return view('admin.orders.show', compact('order', 'orderStatuses'));
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

        return redirect()->route('front.orders.index', $id)
            ->with('success', '訂單已取消');
    }

    // 後台更新訂單
    public function adminUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // 更新訂單狀態
        $order->update([
            'order_status_id' => $request->input('order_status_id'),
        ]);

        return redirect()->route('admin.orders.index', $id)
            ->with('success', '更改訂單狀態成功');
    }
}
