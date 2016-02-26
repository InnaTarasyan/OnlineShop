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

    public function cart2(Request $request)
    {
        $postData=$request->all();

        //decrease the quantity
        if ($postData['product_id'] && ($postData['decrease']) == 1) {
            $rowId = Cart::search(array('id' => $postData['product_id']));
            $item = Cart::get($rowId[0]);
            Cart::update($rowId[0], $item->qty - 1);
            $cart=Cart::content();
            return view('cart', array('cart' => $cart));

        }

    }
}
