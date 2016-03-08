<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Validator;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Image;



class ProductController extends Controller
{
      /*
       *  Deletes the current product
       */
      public function delete($id)
      {
          Product::where('id', '=', $id)->delete();
          $records = Product::where('id', '>', 0)
              ->orderBy('product_name', 'asc')
              ->Paginate(2);

          return view('layouts\users\home')->with('data', $records);
      }

     /*
      *  Updates the current product
      */

     public function update(Request $request)
     {

         $postData = $request->all();
         $model=new Product();

         if($postData['id']!=null)
         {
             $model->id=$postData['id'];
         }
         if($postData['name']!=null) {
             $model->product_name = $postData['name'];
         }
         if($postData['price']!=null) {
             $model->price = $postData['price'];
         }
         if($postData['shortDescription']!=null) {
             $model->short_description = $postData['shortDescription'];
         }
         if($postData['longDescription']!=null) {
             $model->long_description = $postData['longDescription'];
         }
         if($postData['count']!=null) {
             $model->count = $postData['count'];
         }
         if($request->file('image')!=null){

           $destinationPath = 'original'; // upload path
           $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
           $fileName = rand(11111, 99999) . '.' . $extension; // renaming image
           $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
           $model->image = $fileName;
         }else{
             $model->image=$postData['uimage'];
         }

         $storagePath = public_path().'\\original\\'.$model->image;

         if (file_exists($storagePath)) {

             $path = public_path('thumb/' . 'thumb_'.$model->image);
             Image::make($storagePath)->resize(100, 100)->save($path);

         }



         if($model->validate($request)) {

             Product::where('id', $model->id)->update(array('product_name' => $model->product_name,
                                                                 'price'=>$model->price,
                                                                 'short_description'=>$model->short_description,
                                                                 'long_description'=>$model->long_description,
                                                                 'count'=>$model->count,
                                                                 'image'=>$model->image
                                                                   ));
             return view('layouts\products\addProduct')->with('data',$model);
         }
         else{
            return view('layouts\products\addProduct')->with('data',$model)->withErrors($model->getErrors());

         }


     }

    /*
     *  Retrieves data corresponding to selected product id
     */
    public function editProduct($id)
    {

        $data=Product::where('id', '=',$id)
            ->get()[0];


        return view('layouts\products\addProduct')->with('data', $data);

    }

    /*
     *   Stores a new Product to database.
     * Validation is described in corresponding Model class.
     * After that uploaded image is validated, renamed and stored to local 'products' directory, product is stored to database.
     */
    public function store(Request $request)
    {
        $postData = $request->all();

        $model = new Product();

        if($model->validate($request)) {

             if($request->file('image')!=null){
            if ($request->file('image')->isValid()) {
                $img1=$request->file('image');


                $destinationPath = 'original'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renaming image
                $img1->move($destinationPath, $fileName); // uploading file to given path



                $storagePath = public_path().'\\original\\'.$fileName;

                if (file_exists($storagePath)) {

                    $path = public_path('thumb/' . 'thumb_'.$fileName);
                    Image::make($storagePath)->resize(100, 100)->save($path);

                }



                Product::create([
                    'product_name' => $postData['name'],
                    'image' => $fileName,
                    'price' => $postData['price'],
                    'short_description' => $postData['shortDescription'],
                    'long_description' => $postData['longDescription'],
                    'count' => $postData['count']
                ]);

                return redirect('/home');
            } else {
                return redirect('/AddProduct')->withInput()->withErrors($model->getErrors());
            }

        }
            else{
                return redirect('/AddProduct')->withInput()->withErrors($model->getErrors());
            }
        }
        else
        {
            return redirect('/AddProduct')->withInput()->withErrors($model->getErrors());
    }
    }
}