<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function retrieveProducts()
    {
        if (Auth::check()) {
            $records = Product::where('id', '>', 0)
                ->orderBy('product_name', 'asc')
                ->Paginate(2);

            return view('layouts\users\home')->with('data', $records);
        } else {
            return view('layouts\users\login');
        }

    }


    public function retrieveProductByName($name)
    {

        $record=Product::where('product_name', '=',$name)
            ->get();
        if($record!=null){
            return $record[0];}
    }

    public function addProduct()
    {

        if(Auth::user()->isAdmin()) {
            return view('layouts\products\addProduct');
        }
        else{
            return view('layouts\users\login');
        }

    }

    public function displayProduct($name)
    {
        if (Auth::check()) {

            $data=HomeController::retrieveProductByName($name);
            if($data!=null) {
                return view('layouts\products\productDetail')->with('data', $data);
            }
            else{
                LoginController::logOut();
            }
        }
        else{
            return view('layouts\users\login');
        }
    }
}
