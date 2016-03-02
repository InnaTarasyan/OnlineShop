<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('home','HomeController@retrieveProducts') ;
    Route::get('AddProduct','HomeController@addProduct');

    Route::get('ProductDetail/{name}', 'HomeController@displayProduct');

    Route::post('add_action', ['as' => 'AddProduct', 'uses' => 'ProductController@store']);

    Route::post('register_action', ['as' => 'register', 'uses' => 'RegisterController@store']);

    Route::get('register', function () {
        return view('layouts\users\register');
    });

    Route::get('cart', 'CartController@cart');
    Route::get('cartRem', ['as'=>'cart','uses'=>'CartController@cartRem']);

    Route::get('buy', ['as'=>'buy','uses'=>'CartController@buy']);

    Route::post('cart_action', ['as'=>'cart','uses'=>'CartController@store']);

    Route::get('login', function () {
        return view('layouts\users\login');
    });
    Route::post('login_action', ['as' => 'login', 'uses' => 'LoginController@loginCheck1']);

    Route::get('logOut','LoginController@logOut');

});