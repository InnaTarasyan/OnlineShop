<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Input;
use Html;
use App\Models\User;
use App\Models\Product;



class LoginController extends Controller
{

    /*
     *  loggedIn() function checks whether a user is already logged in, when he redirects to 'login' page.
     *  In the case when user is already logged in he is redirected to the 'home' page.
     *  In the other case he remains on 'login' page.
     */
    public function loggedIn()
    {
        if (Auth::check()) {
            $records = Product::where('id', '>', 0)
                ->orderBy('product_name', 'asc')
                ->Paginate(2);

            return view('layouts\users\home')->with('data', $records);
        }
        else {
            return view('layouts\users\login');
        }
    }

    /*
     *  Logs in a new user.
     *  The validation is described in the model class.
     *  Laravel auth mechanism used.
     */

    public function loginCheck(Request $request)
    {

        $model=new User();
        $postData = $request->all();
        if($model->validate($request)) {

            if (Auth::attempt(array('email' => $postData['email'], 'password' => $postData['password']), true))
            {

                return redirect('/home');
            }
            else{
                return redirect('/login')->withErrors(['Wrong User/Password']);
            }
        }
        else {
            return redirect('/login')->withInput()->withErrors($model->getErrors());
        }
    }


    /*
     *  Logs out the user via Laravel 'Auth' mechanism.
     */
    public function logOut()
    {
       Auth::logout();
       return redirect('/login');

    }
}
