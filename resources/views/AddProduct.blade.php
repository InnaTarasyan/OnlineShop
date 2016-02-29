@extends('master')

@section('main_content')
    <div class="container">
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
                </div>
     </div>
        <div class="control-group">

    <label class="control-label">Price</label>
            <div class="controls">
    {!! Form::text('price') !!}
                </div>
    </div>
        <div class="control-group">
    <label class="control-label">Short Description</label>
            <div class="controls">
    {!! Form::text('shortDescription') !!}
                </div>
    </div>
        <div class="control-group">

    <label class="control-label">Long Description</label>
            <div class="controls">
    {!! Form::textarea('longDescription') !!}
                </div>
    </div>
        <div class="control-group">

    <label class="control-label">Upload Image</label>
            <div class="controls">
            {!! Form::file('image') !!}
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

                <br/>
                <br/>
                <div class="bg-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>



    </div>
            </div>
        </div>

@stop
