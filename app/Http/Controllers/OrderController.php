<?php

namespace App\Http\Controllers;

use App\Order;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user:id,name')->with('products')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
        // return $orders;
        return view('Admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
            ->with('user')
            ->with('products')
            ->first();

        return view('Admin.order.show', compact('order'));
    }

    public function sortBy($sort_by)
    {
        switch ($sort_by) {
            case "all":
                $orders = Order::with('user:id,name')
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
                $type = 'all';
                break;

            case "pending":
                $orders = Order::with('user:id,name')
                    ->where('status', '0')
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
                $type = 'pending';
                break;

            case "complete":
                $orders = Order::with('user:id,name')
                    ->where('status', '1')
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
                $type = 'complete';
                break;
        }
        return view('Admin.order.index', compact('orders', 'type'));
    }

    public function edit($id)
    {
        try {
            $order = Order::where('id', $id)
                ->update(['status' => 1]);

            return redirect()
                ->route('order.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Approved Order.']);
        } catch (Exception $e) {
            return redirect()
                ->route('order.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Approve Order.']);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            $order->products()->detach();
            $order->delete();
            return redirect()
                ->route('order.index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Complete Delete Order.']);
        } catch (Exception $e) {
            return redirect()
                ->route('order.index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Fail To Delete Order.']);
        }
    }
}
