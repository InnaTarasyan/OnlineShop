<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /*
     *  Registration of a new user
     *  First the corresponding input is validated (Validation mechanism is described in model class)
     *  After that uploaded image is validated, renamed and stored to local 'uploads' directory, user is stored to database
     */

    public function store(Request $request)
    {
        $postData = $request->all();

        $model = new User();
        if ($model->validate($request)) {

           if($request->file('image')!=null){

            if ($request->file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renaming image
                $request->file('image')->move($destinationPath, $fileName); // uploading file to given path


                User::create([
                    'first_name' => $postData['firstName'],
                    'last_name' => $postData['lastName'],
                    'email' => $postData['email'],
                    'password' => Hash::make($postData['password']),
                    'image_name' => $fileName,
                    'role' => 0
                ]);

                return redirect('/home');
            } else {

                return redirect('/register');
            }

        } else {
               return redirect('/register');

        }
         }
        else{

            return redirect('/register')->withInput()->withErrors($model->getErrors());
        }
    }
}
