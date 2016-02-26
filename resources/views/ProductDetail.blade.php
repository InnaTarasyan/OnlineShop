<!DOCTYPE html>
<html>
    <head>
        <head>
            <title>Welcome</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        </head>
    </head>
    <body>
    @include('header')
    @if(isset($data))
    <div class="container">
        <h1>Product Description</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well">
                            <img class="img-rounded" src="../products/{{ $data->image }}" width="420" height="420"/>
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

    </body>
    @include('footer')
</html>
