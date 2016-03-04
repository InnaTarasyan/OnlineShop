<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    /*
     *   Stores a new Product to database.
     * Validation is described in corresponding Model class.
     * After that uploaded image is validated, renamed and stored to local 'products' directory, product is stored to database.
     */
    public function store(Request $request)
    {
        $postData = $request->all();

        $model = new Product();
        if($model->validate($request))
        {
            if ($request->file('image')->isValid()) {
                $destinationPath = 'products'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renaming image
                $request->file('image')->move($destinationPath, $fileName); // uploading file to given path

                Product::create ( [
                    'product_name' => $postData['name'],
                    'image' => $fileName,
                    'price' => $postData['price'],
                    'short_description'  => $postData['shortDescription'],
                    'long_description'  =>  $postData['longDescription'],
                    'count'=>$postData['count']
                ] );
                return redirect('/home');
            }
            else {
                return redirect('/AddProduct');
            }
        }
        else
        {
            return redirect('/AddProduct')->withInput()->withErrors($model->getErrors());
        }
    }
}