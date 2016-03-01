<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Cart as ModelCart;
use App\Models\Product;


class CartController extends Controller
{

    /*
     * retrieves the content of the cart
     */
    public function cart()
    {
      $cart = Cart::content();
      return view('layouts\cart\cart', array('cart' => $cart));
    }


    /*
     *  Stores a new product to the cart
     */
    public function store(Request $request)
    {
        $postData = $request->all();
        if(isset( $postData['product_name']) && $postData['price']) {
            Cart::add(array(
                array('id' => $postData['product_name'], 'name' => $postData['product_name'], 'qty' => 1, 'price' => intval($postData['price']))));

            $cart = Cart::content();
            return view('layouts\cart\cart', array('cart' => $cart));
        }

        $cart = Cart::content();
        return view('layouts\cart\cart', array('cart' => $cart));
    }


    /*
     * removes selected product from a cart
     */
    public function cartRem(Request $request)
    {
        $postData=$request->all();

        //decrease the quantity
        if ($postData['product_id'] && ($postData['decrease']) == 1) {
            $rowId = Cart::search(array('id' => $postData['product_id']));
            $item = Cart::get($rowId[0]);
            Cart::update($rowId[0], $item->qty - 1);

            $cart = Cart::content();
            return view('layouts\cart\cart', array('cart' => $cart));
        }
        $cart = Cart::content();
        return view('layouts\cart\cart', array('cart' => $cart));
    }



    /*
     *  Buys a new product
     */
    public function buy(Request $request)
    {
        $postData=$request->all();

        DB::transaction(function() use($postData)
        {
            // finds the user
            $user_id=Auth::user()->id;

            // finds the corresponding product id
            $product=Product::
                where('product_name', '=',$postData['product_id'])
                ->get()[0];

            $product_id=$product->id;

            // inserts a new record to cart table
            $values = array('user_id' => $user_id,'product_id' => $product_id);

            ModelCart::create($values);

            // finds the count of corresponding product
            $product_count=Product::
                where('id', '=',$product_id)
                ->get()[0]->count;

            // updates the quantity of corresponding items
            Product::where('id', '=',$product_id)->update(array('count' => $product_count-1));

        });

        $rowId = Cart::search(array('id' => $postData['product_id']));
        $item = Cart::get($rowId[0]);
        Cart::update($rowId[0], $item->qty - 1);
        $cart = Cart::content();
        return view('layouts\cart\cart', array('cart' => $cart));

    }
}
