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

      $postData= $request->all();
      $data = $postData['data'];
      $category=$postData['category'];

      $price1=$postData['price1'];
      $price2=$postData['price2'];


      if($category.""!="category" && $data!="") {

          $categoryObject= Category::where('category_name','=',$category)->get()[0];
          $category_id= $categoryObject->id;
          $records = Product::where('category_id','=',$category_id)
                            ->where(function($query) use($data){
                                $query ->orWhere('product_name', 'LIKE', $data . '%');
                                $query ->orWhere('short_description', 'LIKE', $data . '%');

                            })
                            ->get();

          return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);

      }
       if($category!="" && $data!="")
          {
          $records = Product::where('product_name', 'LIKE', $data . '%')
              ->orWhere('short_description', 'LIKE', $data . '%')
              ->get();

          return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
          }


   }
}
