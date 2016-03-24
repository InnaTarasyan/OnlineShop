<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\Base\Model;

/*
 *  Represents the 'products' table of the database.
 *  Contains the corresponding validation messages.
 */
class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $dateFormat = 'U';


    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    protected $fillable = [ 'id', 'category_name'];

}
