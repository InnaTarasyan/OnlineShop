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
        'shortDescription.required' => 'Please input Short Description',
        'longDescription.required' => 'Please input Long Description',
        'count.required'=>'Please input product count',
        'image.required' => 'Upload the image',
        'count.numeric'=>'The count of the product must be numeric'
    ];

    public $rules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'shortDescription' => 'required',
        'longDescription' => 'required',
        'count'=>'required|numeric',
        'image' => 'required'
    ];


    protected $fillable = [ 'product_name', 'image', 'price', 'short_description' ,'long_description','count'];

}
