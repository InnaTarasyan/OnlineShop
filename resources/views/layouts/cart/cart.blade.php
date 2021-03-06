@extends('layouts.master')

@section('main_content')
<div class="container" style="height: 100%">
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
                <b><h4>Total: <?php echo Cart::total(); ?> USD</h4></b>

                @if(isset($success))
                    <div class="alert alert-success">
                    {{ $success }}
                    </div>
                @endif

                @if(isset($error))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif

            </div>
            </div>
    </div>


@stop

@section('pageScript')
    <script src="{{ URL::asset('js/card/myCard.js') }}"></script>
@stop