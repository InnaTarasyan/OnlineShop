<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\Product;
use DB;


class HomeController extends Controller
{

    public function retrieveProducts()
    {
        if(session('firstName')!=null) {
            $records = DB::table('products')
                ->where('id', '>', 0)
                ->orderBy('product_name', 'asc')
                ->Paginate(2);

            return view('home')->with('data',$records);
        }
        else{
                return view('login');
            }

    }


    public function retrieveProductByName($name)
    {
        $record=DB::table('products')->where('product_name', '=',$name)
            ->get();
        if($record!=null){
            return $record[0];}
    }

    public function addProduct()
    {
        if(session('admin')!=null) {
            return view('addProduct');
        }
        else{
            return view('login');
        }
    }

    public function displayProduct($name)
    {
        if(session('firstName')!=null) {

            $controller = new \App\Http\Controllers\HomeController();
            $data = $controller->retrieveProductByName($name);

            if($data!=null) {
                return view('productDetail')->with('data', $data);
            }
            else{
                $controller=new \App\Http\Controllers\LoginController();
                $controller->logOut();
                return view('login');
            }
        }
        else{
            return view('login');
        }
    }
}
