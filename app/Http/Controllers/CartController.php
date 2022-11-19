<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart()
    {
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        if (Auth::check()) { //Nếu đăng nhập
            $id_user = Auth::user()->id_user;
            $cart = [];
            $cart_list = json_decode(User::find($id_user)->cart);
            if ($cart_list != null) {
                foreach ($cart_list as $cart_item) {
                    $cart[$cart_item->id_product_detail] = $cart_item->pivot->quantity;
                }
            }
            session()->put('cart', $cart);
            $cart_list_item = $this->getCartList($cart);
        } else { //Nếu k đăng nhập
            $cart = session()->get('cart');
            $cart_list_item = $this->getCartList($cart);
        }
        return view('userpage.user_cart', compact('cart_list_item'));
    }

    public function add2Cart(Request $request)
    {
        $msg = 'Out of stock';
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        $cart = session()->get('cart');
        if (Auth::check()) { //Nếu đăng nhập
            $id_user = Auth::user()->id_user;
            $id_detail = $this->get_id_detail($request->id_product, $request->color, $request->size, $request->quantity);
            if ($id_detail) {
                $cart_list = json_decode(User::find($id_user)->cart);
                if ($cart_list != null) {
                    foreach ($cart_list as $cart_item) {
                        $cart[$cart_item->id_product_detail] = $cart_item->pivot->quantity;
                    }
                }
                $cart = $this->checkCart($cart, $id_detail, $request->quantity);
                Cart::updateOrInsert(
                    [
                        'id_user' => Auth::user()->id_user,
                        'id_product_detail' => $id_detail,
                    ],
                    [
                        'quantity' => $cart[$id_detail]
                    ]
                );
                session()->put('cart', $cart);
                $msg = 'Add to cart success';
            }
        } else { //Nếu k đăng nhập
            $id_detail = $this->get_id_detail($request->id_product,$request->color,$request->size);

            $cart = session()->get('cart');
            //var_dump($cart);

            $cart = $this->checkCart($cart, $id_detail, $request->quantity);

            session()->put('cart', $cart);
            //session()->remove('cart');
            //var_dump($cart);
        }
        $data = count($cart);
        return response()->json([
            'data' => $data,
            'msg' => $msg,
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        if (Auth::check()) {
            Cart::updateOrInsert(
                [
                    'id_user' => Auth::user()->id_user,
                    'id_product_detail' => $id,
                ],
                [
                    'quantity' => $request->qty
                ]
            );
        }
        $cart = session()->get('cart');
        $cart[$id] = $request->qty;
        session()->put('cart', $cart);
    }

    public function delFromCart($id)
    {
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        if (Auth::check()) {
            $id_user = Auth::user()->id_user;
            Cart::where(
                [
                    'id_user' => $id_user,
                    'id_product_detail' => $id,
                ]
            )->delete();
        }

        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        $cart_list = session()->get('cart');

        $cart_list_item = $this->getCartList($cart);
        return response()->json([
            'html' => view('userpage.cart_item', compact('cart_list_item', 'cart_list'))->render(),
            'cartItem' => count($cart)
        ]);
    }

    private function getCartList($cart)
    {
        $cart_list_item = [];
        if ($cart == '') {
        } else {
            foreach ($cart as $id_detail => $quantity) {
                $cart_list_item[] = ProductDetail::where(
                    [
                        'id_product_detail' => $id_detail,
                    ]
                )->join('product', 'product.id_product', 'product_detail.id_product')->first();
            }
        }
        return $cart_list_item;
    }

    //Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    // nếu chưa thì thêm mới
    //Ngược lại tăng số lượng thêm 1
    private function checkCart($cart, $key, $qty)
    {
        if ($cart == '') {
            $cart[$key] = $qty;
        } else if (array_key_exists($key, $cart)) {
            $cart[$key] = $cart[$key] + $qty;
        } else {
            $cart[$key] = $qty;
        }
        return $cart;
    }

    private function get_id_detail($id_prd, $color, $size, $quantity)
    {
        $product_detail = ProductDetail::where([
            'id_product' => $id_prd,
            'color' => $color,
            'size' => $size,
        ])->first();
        if ($product_detail->remaining < $quantity)
            return null;
        return $product_detail->id_product_detail;
    }


    public function getCheckoutListUserPage(Request $req)
    {
        // $data = DB::table('order_details')
        //     ->join('product_details', 'order_details.id_product_detail', '=', 'product_details.id_product_detail',)
        //     ->join('products', 'product_details.id_product', '=', 'products.id_product')
        //     ->where('id_order', '=', $id_order)
        //     ->select('order_details.*', 'products.product_name','product_details.size', 'product_details.color', 'product_details.material')
        //     ->get();
        if (Auth::check()) {
            $list_checkout_cart = Cart::where('id_user', Auth::user()->id_user)->get();
            // $id_user = Auth::user()->id_user;
            //->join('cart', 'users.id_user', '=', 'cart.id_user')

            $data = DB::table('cart')
                ->join('product_detail', 'cart.id_product_detail', '=', 'product_detail.id_product_detail')
                ->join('product', 'product_detail.id_product', '=', 'product.id_product')
                ->where('id_user', '=', Auth::user()->id_user)
                ->select('product.product_name', 'cart.quantity', 'product_detail.remaining', 'product_detail.price', 'product_detail.size', 'product_detail.color')
                ->get();
            foreach ($data as $dt) {
                if ($dt->quantity > $dt->remaining) {
                    return redirect()->back()->with(['err'=>'Product "'.$dt->product_name.'" color "'.$dt->color.'" size "'.$dt->size.'" remaining not enough']);
                }
            }
            return view('userpage.user_checkout', compact('data'));
        } else {
            return redirect('login');
        }
    }
}
