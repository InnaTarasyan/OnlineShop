<?php

namespace App\Http\Controllers;


use App\Http\Requests;
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
        $categories = Category::all();
        return view('layouts\search\index')->with('categories', $categories);
    }

    /**
     * Se
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function retrieveData()
    {
        $data     = Input::get('data');
        $category = Input::get('category');
        $price1   = Input::get('price1');
        $price2   = Input::get('price2');
        $count1   = Input::get('count1');
        $count2   = Input::get('count2');


        if(!empty($data)) {
           $records = Product::searchByNameDesc($data);
        }

        if($price1 || $price2) {
            $records = $records->whereBetween('price',array($price1, $price2));
        }
        if($count1 || $count2) {
            $records = $records->whereBetween('price',array($count1, $count2));
        }

        $category_id = Category::where('category_name', '=', $category)->pluck('id');

        if(!$category_id->isEmpty()) {
            $records = $records->where('category_id', '=', $category_id);
        }


        $records  = $records->paginate(1);

        if($records->isEmpty())
        {
            $status="Fail";
        }else{
            $status="Success";
        }


        return response()->json(['status'=>$status,'html'=>View::make('layouts/search/results')->with('data', $records)->render()]);
   }
}
