<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\Product;
use DB;
use Illuminate\Support\Facades\Redirect;
use Cart;


class CartController extends Controller
{

    public function cart()
    {
      $cart = Cart::content();
      return view('cart', array('cart' => $cart));
    }

    public function store(Request $request)
    {
        $postData = $request->all();
        Cart::add(array(
            array('id' => $postData['product_name'], 'name' => $postData['product_name'], 'qty' => 1, 'price' => intval($postData['price']))));

    }

    public function cart2()
    {
        echo "Hello";
        /*
        //update/ add new item to cart
        if (Request::isMethod('post')) {
            $product_id = Request::get('product_id');
            $product = Product::find($product_id);
            Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
        }
        */
    }
}
