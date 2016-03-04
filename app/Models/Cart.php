<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Base\Authenticatable;
use App\Models\Base\Model;

/*
 *  Represents the 'carts' table of database
 */
class Cart extends Model
{

    protected $table = 'carts';
    public $timestamps = false;
    protected $dateFormat = 'U';



    protected $fillable = [
        'user_id', 'product_id'
    ];





}
