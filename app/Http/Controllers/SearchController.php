<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Input;
use Html;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use App\Models\Category;






class SearchController extends Controller
{
   public function load()
   {
       $categories=Category::where('id','>',0)->get();
       return view('layouts\search\index')->with('categories',$categories);
   }

   public function retrieveData(Request $request)
   {
//       dd(Input::all());
      $postData = $request->all();
      $data = $postData['data'];

      //$data= $request->input('data');

      $category=$postData['category'];
     //  $category=$request->input('category');

      $price1=$postData['price1'];
     //  $price1=$request->input('price1');

      $price2=$postData['price2'];
      // $price2=$request->input('price2');

      $count1=$postData['count1'];
     //  $count1=$request->input('count1');

      $count2=$postData['count2'];
     //  $count2=$request->input('count2');
      if($category!="category" && $data!="" && ($price1==0) && ($price2==0) && ($count1==0) && ($count2==0)) {

          $categoryObject= Category::where('category_name','=',$category)->get()[0];
          $category_id= $categoryObject->id;
          $records = Product::where('category_id','=',$category_id)
                            ->where(function($query) use($data){
                                $query ->orWhere('product_name', 'LIKE', $data . '%');
                                $query ->orWhere('short_description', 'LIKE', $data . '%');

                            });
    //                        ->get();
          $records = $records->paginate(1);

          return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);

      }

       if($category=="category" && $data!=""  && ($price1==0) && ($price2==0) && ($count1==0) && ($count2==0))
       {
           $records = Product::getA($data);


           $records = Product::where('product_name', 'LIKE', $data . '%')
               ->orWhere('short_description', 'LIKE', $data . '%');

           $records = $records->paginate(1);
           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
       }


       if($category=="category" && $data!="" && ($price1!=0 || $price2!=0) && ($count1==0) && ($count2==0))
       {
           $records = Product::whereBetween('price',array($price1,$price2))
                ->where(function($query) use($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               });

           $records = $records->paginate(1);
           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
       }

       if($category!="category" && $data!="" && ($price1!=0 || $price2!=0) && ($count1==0) && ($count2==0))
       {
           $categoryObject= Category::where('category_name','=',$category)->get()[0];
           $category_id= $categoryObject->id;

           $records = Product::whereBetween('price',array($price1,$price2))
               ->where(function($query) use ($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               })
               ->where('category_id','=',$category_id);


           $records = $records->paginate(1);
           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
       }

       if($category=="category" && $data!="" && ($price1==0) && ($price2==0) && ($count1!=0 || $count2!=0)) {

           $records = Product::whereBetween('count',array($count1,$count2))
               ->where(function($query) use($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               });


           $records = $records->paginate(1);
           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
       }

       if($category!="category" && $data!="" && ($price1==0) && ($price2==0) && ($count1!=0 || $count2!=0)) {

           $categoryObject= Category::where('category_name','=',$category)->get()[0];
           $category_id= $categoryObject->id;

           $records = Product::whereBetween('count',array($count1,$count2))
               ->where(function($query) use($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               })
               ->where('category_id','=',$category_id);

           $records = $records->paginate(1);

           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);

       }

       if($category=="category" && $data!="" && ($price1!=0 || $price2!=0) && ($count1!=0 || $count2!=0)){

           $records = Product::where(function($query) use ($data,$price1,$price2,$count1,$count2){
                   $query->whereBetween('count',array($count1,$count2));
                   $query->whereBetween('price',array($price1,$price2));
                })
               ->where(function($query) use($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               });

           $records = $records->paginate(1);

           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);

       }

       if($category!="category" && $data!="" && ($price1!=0 || $price2!=0) && ($count1!=0 || $count2!=0)){

           $categoryObject= Category::where('category_name','=',$category)->get()[0];
           $category_id= $categoryObject->id;

           $records = Product::where(function($query) use ($data,$price1,$price2,$count1,$count2){
               $query->whereBetween('count',array($count1,$count2));
               $query->whereBetween('price',array($price1,$price2));
           })
               ->where(function($query) use($data){
                   $query ->orWhere('product_name', 'LIKE', $data . '%');
                   $query ->orWhere('short_description', 'LIKE', $data . '%');

               })
               ->where('category_id','=',$category_id);



           return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);

       }



   }
}
