<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Base\Authenticatable;

class Cart extends Model
{

    protected $table = 'carts';
    public $timestamps = false;
    protected $dateFormat = 'U';



    protected $fillable = [
        'user_id', 'product_id'
    ];





}
