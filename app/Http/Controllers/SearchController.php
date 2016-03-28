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
    /**
     * @return mixed
     */
    public function load()
    {
        $categories = Category::where('id', '>', 0)->get();
        return view('layouts\search\index')->with('categories', $categories);
    }

    public function retrieveData()
    {
        $data     = Input::get('data');
        $category = Input::get('category');
        $price1   = Input::get('price1');
        $price2   = Input::get('price2');
        $count1   = Input::get('count1');
        $count2   = Input::get('count2');


        if(!empty($data) && !$price1 && !$price2 && !$count1 && !$count2) {
           if($category!="category") {
              $category_id = Category::where('category_name', '=', $category)->pluck('id');
              $records = Product::searchByNameDesc($data)->where('category_id', '=', $category_id);
          }else if($category=="category"){
              $records = Product::searchByNameDesc($data);
          }

        }


         if(!empty($data) && ($price1 || $price2) && !$count1 && !$count2) {
             if($category=="category"){
             $records = Product::searchByNameDesc($data)->whereBetween('price',array($price1,$price2));
             } else if($category!="category"){
                 $category_id=Category::where('category_name','=',$category)->pluck('id');
                 $records = Product::searchByNameDesc($data)->whereBetween('price',array($price1,$price2))
                     ->where('category_id','=',$category_id);
             }
         }


         if(!empty($data) && !$price1 && !$price2 && ($count1 || $count2)) {
              if($category=="category"){
              $records = Product::searchByNameDesc($data)->whereBetween('count',array($count1,$count2));
           } else if($category!="category") {
               $category_id=Category::where('category_name','=',$category)->pluck('id');
               $records = Product::searchByNameDesc($data)->whereBetween('count',array($count1,$count2))
                   ->where('category_id','=',$category_id);
           }
         }


          if($data!="" && ($price1 || $price2) && ($count1 || $count2)){
              if($category=="category"){
               $records = Product::searchByNameDesc($data)->where(function($query) use ($data,$price1,$price2,$count1,$count2){
               $query->whereBetween('count',array($count1,$count2));
               $query->whereBetween('price',array($price1,$price2));
               });
            } else if($category!="category"){
               $category_id=Category::where('category_name','=',$category)->pluck('id');
               $records = Product::searchByNameDesc($data)->where(function($query) use ($data,$price1,$price2,$count1,$count2){
                   $query->whereBetween('count',array($count1,$count2));
                   $query->whereBetween('price',array($price1,$price2));
               }) ->where('category_id','=',$category_id);
            }
          }

        $records = $records->paginate(1);
        return response()->json(['html'=>View::make('layouts/search/results')->with('data',$records)->render()]);
   }
}
