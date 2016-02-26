<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;
use Validator;
use App\Person;

class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $postData = $request->all();

        $messages = [
            'firstName.required' => 'First Name is required',
            'email.required' => 'Enter email address',
            'email.email' => 'Enter correct email address',
            'password.required' => 'You have to set a password',
            'cPassword.same:password' => 'The passwords do not match',
            'cPassword.required' => 'Use have to confirm the password',
            'image.required' => 'Upload the image'
        ];
        $rules = [
            'firstName' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/([a-z]{1,})/|regex:/([A-Z]{1,})/|regex:/([\d]{1,})/',
            'cPassword' => 'required|same:password',
            'image' => 'required'
        ];

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect('/register')->withInput()->withErrors($validator->errors());
        } else {

            if ($request->file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                $request->file('image')->move($destinationPath, $fileName); // uploading file to given path


                Person::create ( [
                    'first_name'  =>  $postData['firstName'],
                    'last_name' => $postData['lastName'],
                    'email' => $postData['email'],
                    'password' => md5($postData['password']),
                    'image_name'  => $fileName,
                    'role'=>0
                ] );

                return redirect('/home');
            }
            else {

                return redirect('/register');
            }
        }
    }
}
