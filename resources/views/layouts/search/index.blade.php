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

    <script type="text/javascript">
        $(function(){

            $("#submitSearch").click(function()
            {
                var data=$("#searchText").val();

                var category= $('#categories option:selected').attr('value');

                $.ajax({
                    type: "GET",
                    url: "find",
                   /* data:  { "data": data,"category":category},*/
                    data: 'data='+data+'&category='+category,
                    cache: false,
                         success: function(html)
                           {

                               if(html.html==null)
                               {
                                   $('#result').css('visibility', 'hidden');
                               }else {
                                   $('#result').css('visibility', 'visible');
                               }

                                   var result;
                               result=html.html;

                               /*
                               var newData = html.data;
                               for (var i = 0; i < newData.data.length; i++) {


                                   result+="<div class='row'>";

                                   result+="<div class='col-xs-6'>";
                                   result+="<div class='well'>";

                                   var product = newData.data[i];

                                   result+="<div style='display: inline-block;'>";
                                   result+="<img class='img-circle' src=thumb/thumb_"+product.image+">";
                                   result+="</div>";

                                   result+="<div style='display: inline-block;'  class='text-center'>";
                                   var product_name=product.product_name;
                                   result+=product_name+"<br/>";
                                   var price=product.price;
                                   result+=price+"<br/>";
                                   var short_description=product.short_description;
                                   result+=short_description+"<br/>";
                                   var long_description=product.long_description;
                                   result+=long_description+"<br/>";
                                   result+="</div>";



                                   result+="</div></div></div>";

                               }*/


                               $("#result").html(result);
                           }
                      })
            }
            )
        });
   </script>
</head>

<body style="padding-top: 20px;">



<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 center-block" style="float:none;">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 searchblock">
                <input class="form-control search" type="text" value="" id="searchText" name="searchText" placeholder="Search by name, description">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xm-6 searchblock">
                <button type="button" id="submitSearch" value="Search">Search</button>
            </div>
        </div>

        <div class="row hidden-xs" style="margin-top:10px;">
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
                <select name="size" style="width: 100%">
                    <option value="A">Cost</option>
                    <option value="B">400</option>
                    <option value="C">600</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                <select name="size" style="width: 100%">
                    <option value="A">Count</option>
                    <option value="B">100</option>
                    <option value="C">200</option>
                </select>
            </div>

         </div>

        <div class="row" style="margin-top: 20%;">
            <div id="result" class="container-fluid" style="margin-top: 20px;"></div>
        </div>

        </div>
</div>




</body>
</html>