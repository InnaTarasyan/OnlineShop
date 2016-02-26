<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $dateFormat = 'U';

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $image_name;
    public $role;

    protected $fillable = [ 'first_name', 'last_name', 'email', 'password', 'image_name','role' ];

}
