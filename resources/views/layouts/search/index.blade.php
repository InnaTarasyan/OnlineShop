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





    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        $(function() {


            $("#priceLabel").click(function(){
                //$("#priceDiv").slideToggle("fast");
                $("#priceDiv").toggle("slide");
            });

            $("#countLabel").click(function(){
                $("#countDiv").toggle("slide");
            });

            $( "#slider-range1" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 0, 0 ],
                slide: function( event, ui ) {
                    $( "#cost" ).val( ui.values[ 0 ] + " -" + ui.values[ 1 ] );
                }
            });
            $( "#cost" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
                    " -" + $( "#slider-range1" ).slider( "values", 1 ) );

            $( "#slider-range2" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 0, 0 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$" + $( "#slider-range2" ).slider( "values", 0 ) +
                    " - $" + $( "#slider-range2" ).slider( "values", 1 ) );


        });
    </script>



    <script type="text/javascript">
        $(function(){

            $("#submitSearch").click(function()
            {

                var data=$("#searchText").val();

                var category= $('#categories option:selected').attr('value');

               // var price=parseInt($( "#amount" ).val().replace(/[^0-9\.]/g, ''), "");

                var price=$( "#amount" ).val().match(/[0-9\.]+/g);
                price=price + '';
                var array=price.split(',');
                var price1=array[0];
                var price2=array[1];


                $.ajax({
                    type: "GET",
                    url: "find",
                   /* data:  { "data": data,"category":category},*/
                    data: 'data='+data+'&category='+category+'&price1='+price1+'&price2='+price2,
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
                <label id="priceLabel" for="amount">Price range:</label>
                <div id="priceDiv" style="display: none;">
                <p>
                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range2"></div>
                </div>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                <label id="countLabel" for="cost">Count range:</label>
                <div id="countDiv" style="display: none;">
                <p>
                    <input type="text" id="cost" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range1"></div>
                </div>
            </div>

         </div>

        <div class="row" style="margin-top: 20%;">
            <div id="result" class="container-fluid" style="margin-top: 20px;"></div>
        </div>

        </div>
</div>




</body>
</html>