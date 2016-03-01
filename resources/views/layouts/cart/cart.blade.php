@extends('layouts.master')

@section('main_content')
<div class="container">
        <div class="container-fluid">
            <div class="row">
                <table width="100%">
                    <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
@foreach($cart as $item)
    <tr style="height:50px;">
        <td>
    {{$item->name}}
        </td>
        <td>
    {{$item->qty}}
        </td>
        <td>
    {{$item->price}} dram
        </td>
        <td><a href='#' class="buy"  alt='{{$item->id}}'>Buy Now</a></td>
        <td><a href='#' class="del" alt='{{$item->id}}'>Delete</a></td>
    </tr>
@endforeach
                    </tbody>
                </table>
                <b><h4>Total: <?php echo Cart::total(); ?> dram</h4></b>
</div>
            </div>
    </div>
</body>


<script type="text/javascript">

     $( document ).ready(function() {

            //executed when user wants to buy a product
            $(document).on('click', '.buy', function(e){
                e.stopPropagation();

                var $elem = $(e.target);
                var $var=$elem.attr("alt");
                $(location).attr('href', 'buy?product_id='+$var);

               // var $row = $elem.closest('tr');

            });


           //executed when user wants to delete a product
           $(document).on('click', '.del', function(e){
             e.stopPropagation();

             var $elem = $(e.target);
             var $var=$elem.attr("alt");
             $(location).attr('href', 'cartRem?decrease=1&product_id='+$var);

           });

        });



</script>
@stop
