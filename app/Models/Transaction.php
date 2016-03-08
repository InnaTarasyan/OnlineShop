<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Base\Authenticatable;
use App\Models\Base\Model;

/*
 *  Represents the 'transactions' table of database
 */
class Transaction extends Model
{

    protected $table = 'transactions';
    public $timestamps = false;
    protected $dateFormat = 'U';



    protected $fillable = [
        'user_id', 'product_id','date','quantity'
    ];


}
