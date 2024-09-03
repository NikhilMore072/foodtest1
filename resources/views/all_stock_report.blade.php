
@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div>
       
        <form id="clinicForm" method="get" action="{{ route('all_report') }}">
           <select name="clinic_id" id="clinic_id" onchange="submitForm()">
    <option value="central" {{ $selectedClinicId == "central" ? 'selected' : '' }}>Central Location</option>
    @foreach ($userClinicLocations as $clinicId => $branchName)
        <option value="{{ $clinicId }}" {{ $selectedClinicId == $clinicId ? 'selected' : '' }}>
            {{ $branchName }}
        </option>
    @endforeach
</select>
        </form>
        
        <!-- End of the form for clinic location selection -->

        <!-- Start of the table for displaying data -->
        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Manufacturer Name</th>
                    <th>Available Quantity</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through data and display table rows -->
                @if ($selectedClinicId == "central")
                    @foreach($stocksdtl as $k =>$v)
                        <tr>
                            <td>{{ $v->category_name }}</td>
                            <td>{{ $v->product_name }}</td>
                            <td>{{ $v->manufacturer_name }}</td>
                            <td>{{ $v->total_quantity }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach($data as $k =>$v)
                        <?php   
                            if(isset($v['use_product_model'][0]))
                                $use_qty = $v['use_product_model'][0]['use_qty'];
                            else
                                $use_qty = 0;
                        ?>
                        <tr>
                            <td>{{ $v['category_name'] }}</td>
                            <td>{{ $v['product_name'] }}</td>
                            <td>{{ $v['manufacturer_name'] }}</td>
                            <td>{{ $v['total_quantity']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- End of the table for displaying data -->
    </div>
</main><!-- End #main -->

<!-- Include jQuery -->
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" type="text/javascript"></script> --}}
<!-- Include DataTables jQuery plugin -->
<script src="{{ asset('path/to/jquery.dataTables.min.js') }}"></script> 



<!-- DataTables initialization script -->
<script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable({
            pagingType: "full",
            lengthMenu: [10, 20, 25, 50, 100, -1],
            pageLength: 20,
            dom: 'lBfrtip',
            buttons: [
                { extend: 'pdf', title: 'Data export', className: 'btn btn-primary glyphicon glyphicon-file' },
                { extend: 'print', title: 'Data export', className: 'btn btn-primary glyphicon glyphicon-print' }
            ],
        });

        submitForm();
    });

    function submitForm() {
        document.getElementById("clinicForm").submit();
    }
</script>

@endsection

