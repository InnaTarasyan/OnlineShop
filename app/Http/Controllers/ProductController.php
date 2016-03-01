<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $model = new Product();
        $model->validate($request);
        $model->errors;
        $postData = $request->all();
        $messages = [
            'name.required' => 'Product Name is required',
            'price.required' => 'Product Price is required',
            'shortDescription.required' => 'Please enter Short Description',
            'longDescription.required' => 'Please enter Long Description',
            'image.required' => 'Upload the image'
        ];
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'image' => 'required'
        ];


        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            return redirect('AddProduct')->withInput()->withErrors($validator->errors());
        } else {
            if ($request->file('image')->isValid()) {
                $destinationPath = 'products'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
                Product::create ( [
                    'product_name' => $postData['name'],
                    'image' => $fileName,
                    'price' => $postData['price'],
                    'short_description'  => $postData['shortDescription'],
                    'long_description'  =>  $postData['longDescription']
                ] );
                return redirect('/home');
            }
            else {
                return redirect('/AddProduct');
            }
        }
    }
}