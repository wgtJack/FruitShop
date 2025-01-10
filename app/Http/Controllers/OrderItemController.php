<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // 取得所有訂單項目
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->get();
        return response()->json($orderItems);
    }

    // 新增訂單項目
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem = OrderItem::create($validated);

        return response()->json($orderItem, 201);
    }

    // 顯示特定訂單項目
    public function show($orderId, $productId)
    {
        $orderItem = OrderItem::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->with(['order', 'product'])
            ->firstOrFail();

        return response()->json($orderItem);
    }

    // 更新訂單項目
    public function update(Request $request, $orderId, $productId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem = OrderItem::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->firstOrFail();

        $orderItem->update($validated);

        return response()->json($orderItem);
    }

    // 刪除訂單項目
    public function destroy($orderId, $productId)
    {
        $orderItem = OrderItem::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->firstOrFail();

        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted successfully.']);
    }
}
