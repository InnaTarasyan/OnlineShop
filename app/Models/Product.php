<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\Base\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $dateFormat = 'U';


    public $messages = [
        'name.required' => 'Product Name is required',
        'price.required' => 'Product Price is required',
        'shortDescription.required' => 'Please enter Short Description',
        'longDescription.required' => 'Please enter Long Description',
        'image.required' => 'Upload the image'
    ];

    public $rules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'shortDescription' => 'required',
        'longDescription' => 'required',
        'image' => 'required'
    ];



    protected $fillable = [ 'product_name', 'image', 'price', 'short_description' ,'long_description'];

}
