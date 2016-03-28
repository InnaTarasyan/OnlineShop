<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Model extends EloquentModel
{
    protected $errors;
    protected $rules = [];
    protected $messages = [];


    public function  getErrors()
    {
        return  $this->errors ;
    }


    public function validate(Request $request){
        $validator = Validator::make($request->all(), array_intersect_key($this->rules, $request->all()), $this->messages);

        if ($validator->fails()) {
            $this->errors = $validator->errors();

            return false;
        }

        return true;
    }

    public static function getA($data)
    {
        return static::where(function($query) use($data){
            $query ->orWhere('product_name', 'LIKE', $data . '%');
            $query ->orWhere('short_description', 'LIKE', $data . '%');
        });
    }
}