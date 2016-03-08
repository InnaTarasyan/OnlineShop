<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class HomeController extends Controller
{
    /*
     *  Retrieves the list of products from the database, creates a pagination
     */
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

    /*
     *  Retrieves a product from the database by the provided product name
     */
    public function retrieveProductById($id)
    {

        $record=Product::where('id', '=',$id)
            ->get();
        if($record!=null){
            return $record[0];}
    }


    /*
     *   Checks whether a user is a simple user or an administrator. The user is redirected to the corresponding
     * page according to his role.
     */
    public function addProduct()
    {

        if(Auth::user()->isAdmin()) {
            return view('layouts\products\addProduct');
        }
        else{
            return view('layouts\users\login');

        }

    }

    /*
     *  This function is called when user wants to watch the details of the selected product.
     */
    public function displayProduct($id)
    {

        if (Auth::check()) {

            $data=HomeController::retrieveProductById($id);
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
