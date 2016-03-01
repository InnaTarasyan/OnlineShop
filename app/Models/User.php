<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Base\Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';
    public $timestamps = false;
    protected $dateFormat = 'U';

//    public $first_name;
//    public $last_name;
//    public $email;
//    public $password;
//    public $image_name;
//    public $role;

    public $messages = [
        'firstName.required' => 'First Name is required',
        'email.required' => 'Enter email address',
        'email.email' => 'Enter correct email address',
        'password.required' => 'You have to set a password',
        'cPassword.same:password' => 'The passwords do not match',
        'cPassword.required' => 'Use have to confirm the password',
        'image.required' => 'Upload the image'
    ];

   public $rules = [
       'firstName' => 'required|alpha',
       'email' => 'required|email',
       'password' => 'required|min:6|regex:/([a-z]{1,})/|regex:/([A-Z]{1,})/|regex:/([\d]{1,})/',
       'cPassword' => 'required|same:password',
       'image' => 'required'
   ];



    protected $fillable = [
         'first_name', 'last_name', 'email', 'password', 'image_name','role'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
       if($this->role==0)
           return false;
        else
            return true;
    }
}
