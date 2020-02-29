<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getAddToCart(Request $request, $id)
    {
        try {
            if (Auth::user()) {
                $userId = Auth::id();
                $chkCart = Cart::where('user_id', $userId)->first();
                $product_buy = Product::where('id', $id)->firstOrFail();
                // return $chkCart;
                if (!$chkCart) {
                    //create new cart for this user
                    $new_cart = new Cart;
                    $new_cart->user_id = $userId;
                    $new_cart->save();

                    //add product to this cart
                    $cart_detail = new CartDetail;
                    $cart_detail->cart_id = $new_cart->id;
                    $cart_detail->product_id = $product_buy->id;
                    $cart_detail->qty = 1;
                    $cart_detail->save();
                } else {
                    $cart_details = CartDetail::where('cart_id', $chkCart->id)->get();
                    $chkCartDetailProduct = false;
                    foreach ($cart_details as $cart_detail) {
                        if ($cart_detail->product_id == $product_buy->id) {
                            $chkCartDetailProduct = true;
                            break;
                        }
                    }
                    // return $checkExists;
                    if ($chkCartDetailProduct) {
                        $qty = $cart_detail->qty + 1;
                        CartDetail::where('id', $cart_detail->id)
                            ->update(['qty' => $qty]);
                    } else {
                        $cart_detail = new CartDetail;
                        $cart_detail->cart_id = $chkCart->id;
                        $cart_detail->product_id = $product_buy->id;
                        $cart_detail->qty = 1;
                        $cart_detail->save();
                    }
                }
                if ($request->ajax()) {
                    $user_id = Auth::id();
                    $cart_detail = Cart::where('user_id', $user_id)->with('products')->withCount('products')->first();
                    return $cart_detail;
                }
                return redirect()->route('index');
            } else {
                return view('frontend.loginRequire');
            }
        } catch (Exception $e) {
            return redirect()->route('notFound');
        }
    }

    public function getCheckout(Request $request)
    {
        $user_id = Auth::id();
        $cart_detail = Cart::where('user_id', $user_id)->with('products')->withCount('products')->firstOrFail();
        // return $cart_detail;
        if ($cart_detail) {
            if ($request->ajax()) {
                return $cart_detail;
            } else {
                return view('frontend.checkout', compact('cart_detail'));
            }
        } else {
            if ($request->ajax()) {
                return false;
            } else {
                return redirect()->route('notFound');
            }

        }
    }

    public function postCheckout()
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            $cart_detail = Cart::where('user_id', $user_id)->with('products')->withCount('products')->firstOrFail();
            // return $cart_detail;
            $new_order = new Order;
            $new_order->user_id = $user_id;
            $new_order->code_order = uniqid();
            $new_order->total = 0;
            $new_order->status = 0;
            $new_order->save();
            $order_total = 0;
            foreach ($cart_detail->products as $item) {
                $order_item = new OrderItem;
                $order_item->order_id = $new_order->id;
                $order_item->product_id = $item->id;
                $order_item->quantity = $item->pivot->qty;
                $order_item->price = $item->price;
                $order_item->total = ($item->pivot->qty * $item->price);
                $order_item->save();
                $order_total += $order_item->total;
            }
            $add_order_total = Order::where('id', $new_order->id)->update(['total' => $order_total]);
            // return $add_order_total;
            // return $order_total;
            $cart_detail->products()->detach();
            $cart_detail->delete();
            DB::commit();
            return redirect()
                ->route('index')
                ->with(['flash_type' => 'success', 'flash_message' => 'Success!!! Your Order have Been Complete.']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->route('index')
                ->with(['flash_type' => 'danger', 'flash_message' => 'Fail!!! Somethings wrong when Comment and Rating Product. Please try again.']);
        }

    }

    public function delItemCart($id)
    {
        $del_item = CartDetail::where('product_id', $id)->with('product')->first();
        if ($del_item->product->sale) {
            $sum = ($del_item->product->price - $del_item->product->price * $del_item->product->sale / 100) * $del_item->qty;
        } else {
            $sum = $del_item->product->price * $del_item->qty;
        }
        $del_item->delete();
        return $sum;
    }
}
