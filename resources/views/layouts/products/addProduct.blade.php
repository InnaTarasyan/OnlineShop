@extends('layouts.master')

@section('main_content')
    <div class="container"  style="height: 100%; padding-bottom: 200px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
    {!! Form::open(array('route' => 'AddProduct', 'files' => true, 'class'=>'form-horizontal')) !!}
    <fieldset>
        <div id="legend">
            <legend class="">Add Product</legend>
        </div>
        <div class="control-group">

    <label class="control-label">Name</label>
            <div class="controls">
    {!! Form::text('name') !!}
                <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
     </div>
        <div class="control-group">

    <label class="control-label">Price</label>
            <div class="controls">
    {!! Form::text('price') !!}
                <p class="text-danger">{{ $errors->first('price') }}</p>
                </div>
    </div>
        <div class="control-group">
    <label class="control-label">Short Description</label>
            <div class="controls">
    {!! Form::text('shortDescription') !!}
                <p class="text-danger">{{ $errors->first('shortDescription') }}</p>
                </div>
    </div>
        <div class="control-group">

    <label class="control-label">Long Description</label>
            <div class="controls">
    {!! Form::textarea('longDescription') !!}
                <p class="text-danger">{{ $errors->first('longDescription') }}</p>
                </div>
    </div>
        <div class="control-group">
            <label class="control-label">Count</label>
            <div class="controls">
                {!! Form::text('count') !!}
                <p class="text-danger">{{ $errors->first('count') }}</p>
            </div>
        </div>

        <div class="control-group">

    <label class="control-label">Upload Image</label>
            <div class="controls">
            {!! Form::file('image') !!}
                <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>
</div>
         <div class="control-group">
             <br/>
             <div class="controls">
    {!! Form::submit("Submit") !!}
                 </div>
    </div>

    </fieldset>
    {!! Form::close() !!}


    </div>
            </div>
        </div>

@stop
