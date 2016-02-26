<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use DB;
use Session;
use Html;



class LoginController extends Controller
{
    public function loginCheck(Request $request)
    {
        $postData = $request->all();
        // setting up custom error messages for the field validation
        $messages = [
            'email.required' => 'You have to input email address',
            'password.required' => 'You have to input a password',
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect('/login')->withInput()->withErrors($validator->errors());
        }
        else {

            $user=DB::table('users')
                ->where('email', '=',$postData['email'])
                ->where('password','=', md5($postData['password']))
                ->get();

            if ($user != null){

                Session::set('firstName',$user[0]->first_name);
                Session::set('lastName',$user[0]->last_name);

                $path = 'uploads'.'\\'. $user[0]->image_name;
                Session::set('image',$path);



                if($user[0]->role!=null)
                    Session::set('admin',true);

                return redirect('/home');
            }
            else{
                return redirect('/login')->withErrors(['Wrong User/Password']);
            }

            return redirect('/login');
        }
    }

    public function logOut()
    {
       Session::forget('firstName');
       Session::forget('lastName');
       Session::forget('image');
       Session::forget('admin');
       return redirect('/login');

    }
}
