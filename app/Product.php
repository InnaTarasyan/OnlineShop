<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $dateFormat = 'U';

    public $product_name;
    public $image;
    public $price;
    public $short_description;
    public $long_description;

    protected $fillable = [ 'product_name', 'image', 'price', 'short_description' ,'long_description'];

}
