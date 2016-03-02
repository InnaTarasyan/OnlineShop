@extends('layouts.master')
@section('main_content')
    @if(isset($data))
    <div class="container">
        <h1>Product Description</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well">
                            <img class="img-rounded" src="{{ URL::asset('products/'.$data->image) }}" width="300" height="300"/>
                        <div style="display: inline-block;">
                        </div>
                        <div style="display: inline-block;">
                            {!! Form::open(array('route' => 'cart')) !!}
                            <label class="control-label">Name:</label>
                            {{ Form::hidden('product_name',$data->product_name ) }}
                            {{$data->product_name }}<br/>
                            <label class="control-label">Price:</label>
                         {{$data->price}} <br/>
                            {{ Form::hidden('price',$data->price ) }}
                            <label class="control-label">Description:</label>
                         {{$data->short_description}}<br/>
                            <label class="control-label">Long Description</label>
                         {{$data->long_description}} <br/>
                            {{ Form::submit("Add to Card") }}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
 @stop

