<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->product = new Product();
    }

    public function getProducts()
    {
        try {
            $products = Product::select(
                'id',
                'name',
                'price'
            )->get()->toArray();
            if (!empty($products)) {
                return response()->json(["data" => $products], 200);
            } else {
                return response()->json(array(), 200);
            }
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
}
