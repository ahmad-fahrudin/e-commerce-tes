<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{

    public function shop()
    {
        $product = Product::paginate(8);
        return view('frontend.shop', compact('product'));
    }

    public function singleProduct($id)
    {
        $product = Product::find($id);
        if (isset(Auth::user()->id)) {
            $checkInCart = Cart::where('product_id', $id)
                ->where('user_id', Auth::user()->id)
                ->count();

            return view('frontend.single_product', compact('product', 'checkInCart'));
        } else {
            return view('frontend.single_product', compact('product'));
        }
    }

    public function addToCart(Request $request)
    {
        $addCart = Cart::create([

            "name" => $request->name,
            "price" => $request->price,
            "qty" => $request->qty,
            "image" => $request->image,
            "product_id" => $request->product_id,
            "user_id" => Auth::user()->id,
            "subtotal" => $request->qty * $request->price
        ]);

        if ($addCart) {
            toast('Berhasil menambahkan Ke Keranjang!', 'success')->timerProgressBar();
            return Redirect::route("single.product", $request->product_id)->with(['success' => 'Berhasil menambahkan Ke Keranjang!']);
        }
    }

    public function cart()
    {

        $cartProducts = Cart::select()->where('user_id', Auth::user()->id)
            ->get();
        $subtotal = Cart::select()->where('user_id', Auth::user()->id)->sum('subtotal');

        return view('frontend.cart', compact('cartProducts', 'subtotal'));
    }
    public function deleteFromCart($id)
    {

        $deleteCart = Cart::find($id);
        $deleteCart->delete();
        if ($deleteCart) {
            toast('Berhasil Menghapus dari Keranjang!', 'success')->timerProgressBar();
            return Redirect::route("products.cart")->with(['delete' => 'Menghapus Product Berhasil']);
        }
    }
    public function prepareCheckout(Request $request)
    {
        $price = $request->price;
        $value = Session::put('value', $price);
        $newPrice = Session::get($value);
        if ($newPrice > 0) {
            return Redirect::route("products.checkout");
        }
    }

    public function checkout()
    {
        // Mengambil semua item di keranjang berdasarkan user_id
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        // Menghitung subtotal dari semua item di keranjang
        $checkoutSubtotal = Cart::where('user_id', Auth::user()->id)->sum('subtotal');

        // Menyertakan `product_id` di setiap item keranjang
        foreach ($cartItems as $item) {
            $item->product_id = $item->product->id;
        }

        return view('frontend.checkout', compact('cartItems', 'checkoutSubtotal'));
    }
    public function proccessCheckout(Request $request)
    {
        $productIds = $request->input('product_ids'); // Array of product IDs

        // Lakukan sesuatu dengan $productIds, seperti menyimpan order

        // Contoh menyimpan setiap order item berdasarkan product_id
        foreach ($productIds as $productId) {
            $checkout = Order::create([
                'product_id' => $productId,
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "price" => $request->price,
                "user_id" => $request->user_id,
                "order_notes" => $request->order_notes,
                'status' => 'Menunggu Bayar',
            ]);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            )
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $checkout->snap_token = $snapToken;
        $checkout->save();

        $value = Session::put('value', $request->price);
        $newPrice = Session::get($value);

        if ($checkout) {
            return Redirect::route("products.pay", $checkout->id);
        }
    }
    public function payWithPaypal($id)
    {
        $snapToken = Order::where('id', $id)->value('snap_token');
        return view('frontend.pay', compact('snapToken'));
    }
    public function success()
    {
        // Dapatkan user ID
        $userId = Auth::user()->id;

        // Ambil semua item dari keranjang untuk user ini
        $cartItems = Cart::where('user_id', $userId)->get();

        // Loop melalui setiap item di keranjang
        foreach ($cartItems as $item) {
            // Temukan order yang sesuai dan update statusnya
            $order = Order::where('user_id', $userId)
                ->where('product_id', $item->product_id)
                ->where('status', 'Menunggu Bayar')
                ->first();

            if ($order) {
                $order->status = 'Bayar Berhasil'; // Atau status yang sesuai
                $order->save();
            }

            // Kurangi stok produk
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->qty;
                $product->save();
            }
        }

        // Hapus semua item dari keranjang
        Cart::where('user_id', $userId)->delete();

        return view("frontend.success");
    }
}
