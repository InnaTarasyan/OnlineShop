<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class PurchasesController extends Controller
{
    public function show()
    {

        $id = Auth::user()->id;

        $product = Transaction::leftJoin('products', 'transactions.product_id', '=', 'products.id')->where('user_id','=',$id)->get();

          return view('layouts\purchases\purchases')->with('data', $product);


    }
}
