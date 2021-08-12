<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Discount;
use Illuminate\Http\Request;
use Exception;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getCart()
    {
        try {
            $cart = [];
            $cart['total'] = Cart::get()->toArray();
            $cart['items'] = CartItems::join('products', 'products.id', '=', 'cart_items.product_id')
            ->select('name', 'discount','total')
            ->where ('cart_items.product_id','!=',0)
            ->get()->toArray();
            if (!empty($cart)) {
                return response()->json(["data" => $cart], 200);
            } else {
                return response()->json(["data" => array()], 200);
            }
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $params = $request->all();
            $itemTotal = $params['price']*$params['quantity'];
            $discount = $this->findDiscount($params['product_id'], $params['quantity'], $params['price'], $itemTotal);
            $update_cart_items = CartItems::updateOrCreate(
                [
                    'product_id' => $params['product_id']
                ],
                [
                    'price' => $params['price'],
                    'quantity' => $params['quantity'],
                    'discount' => isset($discount['item_disc']) ? $discount['item_disc'] : 0 ,
                    'total' => $itemTotal
                ]
            );
            $total = $this->findTotal($params['quantity'], $params['price']);
            $discount = $this->findDiscount($params['product_id'], $params['quantity'], $params['price'], $total);

            $update_cart = Cart::updateOrCreate(
                [
                    'id' => 1
                ],
                [
                    'subtotal' => $total - $discount['cart_disc'],
                    'discount' => isset($discount['cart_disc']) ? $discount['cart_disc'] : 0 ,
                    'total' => $total
                ]
            );
            return response()->json($update_cart, 201);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function findDiscount($productId, $quantity, $price, $total)
    {
        try {
                $item_discount = $cart_discount = 0;
                $discount_arr = [];
                $discount = Discount::get()->toArray();
                if (!empty($discount)) {
                    foreach ($discount as $key => $value) {
                            if(!$value['discount_type']){
                                if($value['product_id']==$productId){
                                    if($value['min_value'] <= $quantity){
                                          $item_discount = $quantity*$value['discount_amount'];
                                    }
                                }
                            }
                            else{
                                if($total>=$value['min_value']){
                                    $cart_discount+= $value['discount_amount'];
                                }
                            }
                        }
                    $discount_arr['cart_disc'] = $cart_discount;
                    $discount_arr['item_disc'] = $item_discount;
                    return $discount_arr;
                } else {
                    return array();
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
    }


    public function findTotal($quantity, $price)
    {
        try{
            $cartItems = CartItems::get()->toArray();
            $totalVal = 0;
            if(!empty($cartItems)){
                foreach ($cartItems as $key => $value) {
                    $totalVal+= $value['quantity']*$value['price'];
                }
            }
            else{
                $totalVal+= $quantity*$price;
            }
            return $totalVal;
        }
        catch(Exception $ex){
             return $ex->getMessage();
        }
       
    }

    public function deleteCart(){
        try{
            Cart::query()->truncate();
            CartItems::query()->truncate();
            return 1;
        }
        catch(Exception $ex){
             return $ex->getMessage();
        }
    }
}
