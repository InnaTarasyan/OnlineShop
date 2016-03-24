<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/myCss.css') }}">
    <script src="{{ URL::asset('js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootbox.js') }}"></script>

</head>
<body>

<!--brings product info-->
<div class="container"  style="height: 100%">
    @if(count($data)>0)
        <h2> Products </h2>
        @foreach ( $data as $key => $value )
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="well">
                            <div>
                                <div style="display: inline-block;">
                                   <img onmouseover="" style="cursor: pointer;" class="img-circle" alt="{{ $value->image }}" src="{{ URL::asset('thumb/thumb_'.$value->image) }}" width="100" height="100" onclick="location.href='{{ URL::route('ProductDetail', $value->id)}}'"/>
                                </div>
                                <div style="display: inline-block;"  class="span12 text-center">
                                    <label class="control-label">Name:</label>
                                    {{ $value->product_name }} <br/>
                                    <label class="control-label">Price:</label>
                                    {{ $value->price }}<br/>
                                    <label class="control-label">Description:</label>
                                    {{ $value->short_description }} <br/>
                                    <label class="control-label">Category:</label>
                                    {{ $value->category->category_name }} <br/>
                                    <label class="control-label">Count:</label>
                                    {{ $value->count }} <br/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        Nothing Found
    @endif
</div>

<div class="container">



</div>

</body>