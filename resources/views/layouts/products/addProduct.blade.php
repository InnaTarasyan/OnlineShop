@extends('layouts.master')

@section('main_content')
    <div class="container"  style="height: 100%">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
    @if(isset($data))
    {!! Form::open(array('route' => 'Update', 'files' => true, 'class'=>'form-horizontal')) !!}
    @else
    {!! Form::open(array('route' => 'AddProduct', 'files' => true, 'class'=>'form-horizontal')) !!}
    @endif
    <fieldset>
        <div id="legend">
            @if(isset($data))
             <legend class="">Edit Product</legend>
            @else
            <legend class="">Add Product</legend>
            @endif
        </div>
        <div class="control-group">

            @if(isset($data->id))
            {{ Form::hidden('id',$data->id) }}
            @endif

    <label class="control-label">Name</label>
            <div class="controls">
   @if(isset($data->product_name))
     {!! Form::text('name',$data->product_name) !!}
        @else
     {!! Form::text('name') !!}
   @endif
                <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
     </div>
        <div class="control-group">

    <label class="control-label">Price</label>
            <div class="controls">
    @if(isset($data->price))
      {!! Form::text('price',$data->price) !!}
     @else
      {!! Form::text('price') !!}
     @endif

                    <p class="text-danger">{{ $errors->first('price') }}</p>
                </div>
    </div>
        <div class="control-group">
    <label class="control-label">Short Description</label>
            <div class="controls">
    @if(isset($data->short_description))
      {!! Form::text('shortDescription',$data->short_description) !!}
    @else
      {!! Form::text('shortDescription') !!}
     @endif

                <p class="text-danger">{{ $errors->first('shortDescription') }}</p>
                </div>
    </div>
        <div class="control-group">

    <label class="control-label">Long Description</label>
            <div class="controls">
    @if(isset($data->long_description))
      {!! Form::textarea('longDescription',$data->long_description,['rows' => 2, 'cols' => 40]) !!}
    @else
      {!! Form::textarea('longDescription',null,['rows' => 2, 'cols' => 40]) !!}
    @endif

                <p class="text-danger">{{ $errors->first('longDescription') }}</p>
                </div>
    </div>
        <div class="control-group">
            <label class="control-label">Count</label>
            <div class="controls">
    @if(isset($data->count))
     {!! Form::text('count',$data->count) !!}
    @else
     {!! Form::text('count') !!}
    @endif
                <p class="text-danger">{{ $errors->first('count') }}</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Category</label>
            <div class="controls">
                 @if(isset($data->category_id))
                 {{Form::select('category_id', array('1' => 'Beverages', '2' => 'HouseHold','3'=>'Fruits'),$data->category_id )}}
                 @else
                {{Form::select('category_id', array('1' => 'Beverages', '2' => 'HouseHold','3'=>'Fruits'), '1')}}
                 @endif
                    <p class="text-danger">{{ $errors->first('category') }}</p>
            </div>
        </div>

        <div class="control-group">


     @if(isset($data->image))
        {{ Form::image('original/'.$data->image,'Image', array( 'width' => 70, 'height' => 70 )) }}
            {{ Form::hidden('uimage',$data->image) }}
                <label class="control-label">Update Image</label>
                {!! Form::file('image') !!}
     @else
        <label class="control-label">Upload Image</label>
        <div class="controls">
             {!! Form::file('image') !!}
         <p class="text-danger">{{ $errors->first('image') }}</p>
        </div>
     @endif

</div>
         <div class="control-group">
             <br/>
             <div class="controls">
                 @if(isset($data))
    {!! Form::submit("Edit") !!}
                 @else
    {!! Form::submit("Submit") !!}
                 @endif
                 </div>
    </div>

    </fieldset>
    {!! Form::close() !!}


    </div>
            </div>
        </div>

@stop
