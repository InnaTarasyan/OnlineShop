@extends('layouts.master')
@section('main_content')

   <script language="text/javascript">
       $(function () {
           $("img").click(function() {
               $(this).css('border', "solid 6px red");
           });
       });
   </script>

<!--image slider-->
   <div id="myCarousel" class="carousel slide" data-ride="carousel">

       <ol class="carousel-indicators">
           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
           <li data-target="#myCarousel" data-slide-to="1"></li>
           <li data-target="#myCarousel" data-slide-to="2"></li>
           <li data-target="#myCarousel" data-slide-to="3"></li>
       </ol>


       <div class="carousel-inner" role="listbox">
           <div class="item active">
               <img src="products/img.jpg" alt="Chania">
           </div>

           <div class="item">
               <img src="products/img2.jpg" alt="Chania">
           </div>

           <div class="item">
               <img src="products/img.jpg" alt="Flower">
           </div>

           <div class="item">
               <img src="products/img2.jpg" alt="Flower">
           </div>
       </div>


       <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
           <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
           <span class="sr-only">Previous</span>
       </a>
       <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
           <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
           <span class="sr-only">Next</span>
       </a>
   </div>


   <!--brings product info-->
    <div class="container">
       <h2> Products </h2>
        @if(isset($data))
    @foreach ( $data as $key => $value )
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well">
                        <div>
                            <div style="display: inline-block;">
                        <img class="img-circle" alt="{{ $value->image }}" src="products/{{ $value->image }}" width="100" height="100" onclick="location.href='ProductDetail/{{ $value->product_name }}'"/>
                            </div>
                            <div style="display: inline-block;"  class="span12 text-center">
                                <label class="control-label">Name:</label>
                        {{ $value->product_name }} <br/>
                                <label class="control-label">Price:</label>
                        {{ $value->price }}<br/>
                                <label class="control-label">Description:</label>
                        {{ $value->short_description }} <br/>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
            @endif
    </div>

   <div class="container">
       <div class="row">
           <div class="col-md-6 col-md-offset-6">

       @if(isset($data))
   <?php echo $data->render(); ?>
           @endif


    </div>
           </div>
       </div>
    <br/>


@stop