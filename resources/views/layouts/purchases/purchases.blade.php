@extends('layouts.master')
@section('main_content')


<link rel="stylesheet" href="httpS://cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

<div class="container" style="height: 100%">
    <h3>My Purchases</h3>
    <br/>
    <div class="container-fluid">
        <div class="row">
@if(isset($data))
<table id="myTable">
    <thead><th>Product Name</th><th>Date</th><th>Quantity</th></thead>
    <tbody>
    @foreach ( $data as $key => $value )
      <tr>
          <td>{{ $value->product_name }}</td><td>{{ $value->date }}</td><td>{{ $value->quantity }}</td>
      </tr>
     @endforeach
    </tbody>
</table>
@endif
</div>
 </div>
    </div>

@stop
@section('pageScript')
    <script src="{{ URL::asset('js/jquery-1.12.1.min.js') }}"></script>
    <script  type="text/javascript" src="httpS://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" ></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("table#myTable").dataTable();
        });

    </script>
@stop