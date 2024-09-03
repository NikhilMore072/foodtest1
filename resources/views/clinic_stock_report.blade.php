
@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div>

        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Category Name
                    </th> 
                    <th>
                        Product Name
                    </th>
                    <th>
                        Manufacturer Name
                    </th>
                                 
                     <th>
                        Available Quantity
                    </th>
                  
                </tr>
            </thead>

            <tbody>
                
                @foreach($data as $k =>$v)
                <td>
                    {{$v['category_name']}}
                </td>
                <td>
                    {{$v['product_name']}}
                </td>
                <td>
                    {{$v['manufacturer_name']}}
                </td>
              
                <td>
                    {{$v['available_qty']}}
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main><!-- End #main -->
    
<!-- Include jQuery -->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- Include DataTables jQuery plugin -->
<script src="{{ asset('path/to/jquery.dataTables.min.js') }}"></script> 

<style>
    .dataTables_length select {
        height: 40px;
    }

    .dataTables_length {
        text-align: right;
        margin-bottom: 20px; /* Adjust margin as needed */
    }

    .dataTables_length label {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .dataTables_filter input {
        height: 35px;
        width: 80px;
        margin-bottom: 20px;
    }

    .dataTables_paginate a {
        cursor: pointer;
        padding: 6px 12px;
        margin: 0 4px;
        border: 1px solid #ddd;
        color: #337ab7;
        border-radius: 3px;
        text-decoration: none;
        display: inline-block;
    }

    .dataTables_paginate .first,
    .dataTables_paginate .last {
        background-color: #007bff;
        color: #fff;
    }

    .dataTables_paginate .previous,
    .dataTables_paginate .next {
        background-color: #87cefa;
        color: #333;
    }

    .dataTables_paginate .current,
    .dataTables_paginate a:hover {
        background-color: #337ab7;
        color: #fff;
    }
</style>

@endsection