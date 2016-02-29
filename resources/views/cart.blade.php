@extends('master')

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
        <td><a href='#' onclick="f1(this)" alt='{{$item->id}}'>Buy Now</a></td>
        <td><a href='#' onclick="f2(this)" alt='{{$item->id}}'>Delete</a></td>
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


      //executed when user wants to buy a product

        function f1(obj){
            bootbox.confirm("Are you sure you want to buy this product?", function(confirmed) {
               if(confirmed)
               {
                   $var=$(obj).attr("alt");
                   $(location).attr('href', 'buy?product_id='+$var);
               }
            });
        };


        //executed when user wants to delete a product from selected list

        function f2(obj){
            bootbox.confirm("Are you sure you want to delete this product?", function(confirmed) {
                if(confirmed)
                {
                    $var=$(obj).attr("alt");
                    $(location).attr('href', 'cart2?decrease=1&product_id='+$var);
                }
            });
        };


</script>
@stop
