@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">

      <div class="col-md-8 col-md-offset-2 text-center">
        <div class="panel panel-default">
          <div class="panel-heading">
            <button class="btn btn-primary btn-block">
              <b>Search Students</b>
            </button>
          </div>  
          <div class="panel-body">
            <form action="" method="post" class="form-inline" id="search-formfff">

               <div class="form-group">
                 <label for="month">Select Month</label>
                 {{ Form::selectMonth('month',  null, ['placeholder' => '---Select Month','class' => 'form-control']) }}
                </div>

                <div class="form-group">
                  <select  id="course" class="form-control" name="course">
                    <option value="">---Select Class</option>
                   @foreach($courses as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

               <div class="form-group">
                 <button class="btn btn-primary" type="submit">Submit</button>
                 <a href="" class="btn btn-warning">Refresh</a>
               </div>
            </form>
          </div>
        </div>      
      </div>


      <div class="col-md-12">
        <br>
     	  <div class="panel panel-default">
          <div class="panel-heading">
            <button class="btn btn-primary btn-block">Unpaid Tuition Fee Students({{ $asession['name'] }})</button>
          </div>
          <div class="panel-body">
            <div class="table-responsive text-center">
              <table class="table table-bordered  table-hover" id="unpaid_tutuion_students">
                <thead>
                  <tr>
		                <th class="text-center">Serial No.</th>
		                <th class="text-center">Student Name</th>
		                <th class="text-center">Reg. No.</th>
		                <th class="text-center">Course</th>
		                <th class="text-center">Father Name</th>
		                <th class="text-center">Mother Name</th>
		                <th class="text-center">Profile</th>
                    <th class="text-center">Pay Tuition Fee</th>
                    <th class="text-center">Tuition Fee Details</th>
		              </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

@stop

@section('script')
   
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
   var oTable = $('#unpaid_tutuion_students').DataTable({
     processing: true,
     serverSide: true,
     dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '/staff/tution/unpaid/ajax',
            data: function (d) {

                d.course = $('select[name=course]').val();
                 d.month = $('select[name=month]').val();
               

            }
        },

        columns: [
                     { data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'name', name: 'name' },
                      { data: 'reg_no', name: 'reg_no' },
                      {data: 'courses.name', name: 'courses.name'},
                      { data: 'father_name', name: 'father_name' },
                      { data: 'mother_name', name: 'mother_name' },
                      {data: 'profile', name: 'profile', orderable: false, searchable: false},
                      {data: 'pay_tutuion_fee', name: 'pay_tutuion_fee', orderable: false, searchable: false},
                      {data: 'details_tutuion_fee', name: 'details_tutuion_fee', orderable: false, searchable: false},


        ]
    });

    $('#search-formfff').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>


@stop
