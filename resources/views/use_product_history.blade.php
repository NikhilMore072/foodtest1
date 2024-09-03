

@extends('layouts.app_new')

@section('content')
    <main id="main" class="main">
        <div>
            <table id="table_id" class="table table-condensed table-striped table-hover">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Manufacturer Name</th>
                        <th>User Name</th>
                        <th>Used Qty</th>
                        <th>Timeline</th>
                       
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $k => $v)
                        <tr>
                            <td>{{ $v->tableDispatch->category_name }}</td>
                            <td>{{ $v->tableDispatch->product_name }}</td>
                            <td>{{ $v->tableDispatch->manufacturer_name }}</td>
                            {{-- <td>{{ $v->user->name }}</td> --}}
                            <td>{{ optional($v->user)->name }}</td>
                            <td>{{ $v->use_qty }}</td>
                            <td>{{ \Carbon\Carbon::parse($v->created_at)->format('g:i A d/m/Y') }}</td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main><!-- End #main -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
@endsection
