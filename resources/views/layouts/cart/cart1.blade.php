@extends('layouts.master')
@section('main_content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css">


<div class="container" style="height: 100%">
    <h3>Shopping Cart</h3>
    <br/>
    <div class="container-fluid">
        <div class="row">

<table id="myTable" class="display" cellspacing="0" width="100%">
  <thead><th></th><th>Product Name</th><th>Quantity</th><th>Price</th><th></th></thead>
  <tfoot><th></th><th>Product Name</th><th>Quantity</th><th>Price</th><th></th></tfoot>
    <tbody>
    @foreach ( $cart as $item )
     <tr><td></td><td>{{ $item->name }}</td><td>{{ $item->qty }}</td><td>{{ $item->price }}</td><td><a href="#" class="del" alt='{{$item->id}}'>Delete</a></td></tr>
    @endforeach
    </tbody>
</table>
<button onclick="retrieveSelected()">Buy Selected Items</button>
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

    <script src="{{ URL::asset('js/jquery-1.12.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script  type="text/javascript" src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js" ></script>
    <script src="{{ URL::asset('js/card/myCard.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>


    <script type="text/javascript">

      function retrieveSelected()
      {
          var data=oTable.rows('.selected').data();

          var marr=[];


          $.each(data, function(index, item) {
              marr.push(item[1]);

          });


          $(location).attr('href', 'buyMultiple?data='+JSON.stringify(marr));
      }

        var oTable;
        $(document).ready(function() {
                     oTable= $('#myTable').DataTable( {
                        columnDefs: [ {
                            orderable: false,
                            className: 'select-checkbox',
                            targets:   0
                        } ],

                        select: {
                            style:    'os',
                            selector: 'td:first-child'
                        },
                        order: [[ 1, 'asc' ]]
                    } );

                    /*
                    $('#myTable tbody tr').on('click', function (event) {


                        var table = $('#myTable').DataTable();
                        // var allData = table.rows().data();
                        var idx = table
                                .row(this)
                                .index();

                        var cell = table.cell(this).data;
                        var selected_item = table.row(idx).data()[1];

                        //alert(selected_item);
                    });*/

                }
        );


    </script>
    @stop
