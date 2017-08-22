@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
         <button class="btn btn-primary btn-block">
            Total hostel fee collection({{ $asession['name'] }})
         </button>
        </div>
        <div class="panel-body">
          <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i>  {{ $total }}</h1>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
         <button class="btn btn-primary btn-block">
            Search hostel fee transaction({{ $asession['name'] }})
         </button>
        </div>
        <div class="panel-body">
          <div class="text-center"  id="sandbox-container">
            <form method="" id="search-formfff" class="form-inline" role="form">

              <div class="input-daterange form-group input-group" id="datepicker">
                <span class="input-group-addon">From</span>
                <input type="text" class="input-sm form-control" id="start_at" name="start_at">
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" id="end_at" name="end_at">
              </div>

              <div class="form-group">
                <select  id="course" class="form-control" name="course" >
                      <option value="">---Select Course</option>
                     @foreach($courses as $key=>$value)
                      <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                  <button type="submit" class=" btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">
            All Hostel Fee Transactions({{ $asession['name'] }})
          </button>
        </div>
        <div class="panel-body">
          <div class="table-responsive text-center">
            <table class=" table table-bordered  table-hover" id="hostel_fee">
              <thead>
                <tr>
                  <th class="text-center col-sm-1">Serial No.</th>
                  <th class="text-center col-sm-2">Reg. No.</th>
                  <th class="text-center col-sm-1">Course</th>
                  <th class="text-center col-sm-1">Date</th>
                  <th class="text-center col-sm-1">Total</th>
                  <th class="text-center col-sm-2">Remarks</th>
                  <th class="text-center col-sm-1">View</th>
                  <th class="text-center col-sm-1">Print</th>
                  <th class="text-center col-sm-1">Download</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('script')

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/datatables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
        $('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    forceParse: false,
    autoclose: true
});


})
    </script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
   var oTable = $('#hostel_fee').DataTable({
     processing: true,
     serverSide: true,
     dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '/staff/fee_analysis/hostel_transactions/ajax',
            data: function (d) {
               d.start_at = $('input[name=start_at]').val();
               d.end_at = $('input[name=end_at]').val();
               d.course = $('select[name=course]').val();


            }
        },

        columns: [
                      { data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'students.reg_no', name: 'students.reg_no' },
                      {data: 'courses.name', name: 'courses.name'},
                      { data: 'created_at', name: 'created_at' },
                      {data: 'total', name: 'total', orderable: false, searchable: false},
                      { data: 'remarks', name: 'remarks' },
                      {data: 'view_hostel_fee', name: 'view_hostel_fee', orderable: false, searchable: false},
                      {data: 'print_hostel_fee', name: 'print_hostel_fee', orderable: false, searchable: false},
                      {data: 'download_hostel_fee', name: 'download_hostel_fee', orderable: false, searchable: false},


        ]
    });

    $('#search-formfff').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });


</script>


@stop
