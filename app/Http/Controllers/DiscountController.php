<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Exception;

class DiscountController extends Controller
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

    public function getDiscount()
    {
        try {
            //$params = $request->all();
            //$details = $this->product->getAllProductDetails($params);
            //$products = $this->product->get()->toArray();
            $cart = Cart::get()->toArray();
            if (!empty($products)) {
                return response()->json($cart, 200);
            } else {
                return response()->json(array(), 200);
            }
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function addDiscount()
    { }
}
