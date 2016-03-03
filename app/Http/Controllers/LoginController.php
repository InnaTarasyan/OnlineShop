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



class LoginController extends Controller
{

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


    public function logOut()
    {
       Auth::logout();
       return redirect('/login');

    }
}
