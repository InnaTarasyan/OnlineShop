@extends('layouts.master')
<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
@section('main_content')

<div class="row" style="height: 100%">
    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 center-block" style="float:none;">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 searchblock">
                <input class="form-control search" type="text" value="" id="searchText" name="searchText" placeholder="Search by name, description">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 searchblock">
               <button type="button" id="submitSearch" value="Search"  class="btn btn-default">Search</button>
            </div>
        </div>

        <div class="row hidden-xs" style="margin-top: 5px;">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                <select name="categories" id="categories" style="width: 100%">
                    <option  value="category" selected>Category</option>
                    @if(isset($categories))
                        @foreach ( $categories as $key => $value )
                    <option value="{{$value->category_name}}" >{{$value->category_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                <!--<input type="range"/>-->
                <label id="priceLabel" for="amount" style="width: 100%;">Price range:</label>
                <div id="priceDiv" style="display: none;">
                <p>
                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range2"></div>
                </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                <label id="countLabel" for="count" style="width: 100%;">Count range:</label>
                <div id="countDiv" style="display: none;">
                <p>
                    <input type="text" id="count" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range1"></div>
                </div>
            </div>

         </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 searchblock">
                <div id="res"></div>
                <div id="result" class="container-fluid" style="margin-top: 20px;"></div>
            </div>
        </div>

        </div>
</div>

@stop
@section('pageScript')

    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootbox.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-1.12.2.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('js/search/search.js') }}"></script>
@stop