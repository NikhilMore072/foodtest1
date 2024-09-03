
@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <!-- <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/scan_product')}}"> Product Scan </a>
    </div> -->
    <div>
        
        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Manufacturer Name</th>
                    <th>Product Name</th>
                    <th>Requested Quantity</th>
                    <th>Dispatch Quantity</th>
                    <th>Barcode Id</th>
                    <th>Updated Quantity</th>
                    <th>Used Quantity</th>
                    <th>Available Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k =>$v)
                    <?php 
                    if(isset($v['use_product_model'][0]))
                        $use_qty = $v['use_product_model'][0]['use_qty'];
                    else
                        $use_qty = 0;
                    $available_qty = $v['updated_qty'] - $use_qty;
                    ?>
                    <tr>
                        <td>{{$v['category_name']}}</td>
                        <td>{{$v['manufacturer_name']}}</td>
                        <td>{{$v['product_name']}}</td>
                        <td>{{$v['required_qty']}}</td>
                        <td>{{$v['provided_qty']}}</td>
                        <td>{{$v['barcode_id']}}</td>
                        <td>{{$v['updated_qty']}}</td>
                        <td>{{$use_qty}}</td>
                        <td>{{$available_qty}}</td>
                        <td>
                            @if($available_qty <= 0)
                                <button type="button" class="btn btn-info edit" onclick="alert('Available quantity is less than 1')">Edit Use product</button>
                            @else
                                <button type="button" class="btn btn-info edit" data-toggle="modal" data-target=".bd-example-modal-lg" row_id="{{$v['id']}}" available_qty="{{$available_qty}}" onclick="viewOrders('{{ $v['barcode_id'] }}','{{$v['id']}}', {{$available_qty}})">Edit Use product</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class=" mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                  <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Barcode ID: #<strong class="order_num"></strong></p>
                  </div>
                  <hr>
                </div>
                <div class="">
                  <div class="row my-2 mx-1 justify-content-center">
                    <div class="form-group row">
                      <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Use Quantity') }}</label>
                      <div class="col-md-6">
                          <input id="qty" type="number" class="form-control qty" name="qty" required autocomplete="qty">
                          <input id="qty_id" type="hidden" class="form-control qty_id" name="id" required autocomplete="id">
                          <input id="available_qty" type="hidden" class="form-control available_qty" name="available_qty">
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success submit">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function viewOrders(order_id, row_id, available_qty) {
    $('.qty').val('');
    $('.order_num').text(order_id);
    $('.qty_id').val(row_id);
    $('.available_qty').val(available_qty);
}

$(document).on('click', ".submit", function(event) {
    event.preventDefault();    
    var recive_id = $('.qty_id').val();
    var qty = $('.qty').val();
    var available_qty = $('.available_qty').val();
    if(qty <= 0) return alert("Quantity should be greater than 0");
    if(qty > available_qty) return alert("Quantity should be less than or equal to available quantity");
    $.ajax({
        url: 'get_use_id',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            recive_id: recive_id,
            qty: qty
        },
        dataType: 'JSON',
        success: function(data) {
            window.location.reload();
        }
    });
});
</script>
@endsection
