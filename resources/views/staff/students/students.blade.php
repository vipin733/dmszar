@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
 @if($students)

  <div class="col-md-12">

      <div class="col-sm-4  text-center">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-primary btn-block">
                <b>Total Students</b>
              </button>
            </div>  
            <div class="panel-body">
              <h1><strong>{{$students}}</strong></h1>
            </div>
          </div>  
      </div>      
              

      <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-primary btn-block">
                <b>Search Students</b>
              </button>
            </div>  
            <div class="panel-body">

              <form action="" method="post" class="form-inline" id="search-formfff">

                <div class="form-group">
                  <select  id="created_course" class="form-control" name="created_course">
                    <option value="">---Select Admission Class</option>
                   @foreach($courses as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <select  id="session" class="form-control" name="session">
                    <option value="">---Select Admission Session</option>
                   @foreach($sessions as $session)
                    <option value="{{ $session->asessions['id'] }}">{{ $session->asessions['name']}}</option>
                    @endforeach
                  </select>
                </div>

                 <div class="form-group">
                   <button class="btn btn-primary" type="submit">Submit</button>
                   <a  class="btn btn-warning"  href="">Refresh</a>
                 </div>

              </form>

            </div>
        </div>      
      </div>

  </div>   
      <br>   
 

  <div class="col-md-12 studentprofile">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         <b>Students Information</b>
        </button>
      </div>  
      <div class="panel-body"> 
       
        <div class="table-responsive text-center">
          <table class=" table table-bordered  table-hover" id="staff_students">
            <thead>
              <tr>
                <th class="text-center">Serial No</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Reg. No.</th>
                <th class="text-center">Date of Admission</th>
                <th class="text-center">Admission Session</th>
                <th class="text-center">Admission Class</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Mother Name</th>
                <th class="text-center">Status</th>
                <th class="text-center">View Profile</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
 @else
  <h1 class="text-center">No Students Found!</h1>
 @endif
</div>


@stop

@section('script')
   
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
   var oTable = $('#staff_students').DataTable({
     processing: true,
     serverSide: true,
     dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '/st/students_ajax',
            data: function (d) {

                d.created_course  = $('select[name=created_course]').val();
                d.session         = $('select[name=session]').val();
               

            }
        },

        columns: [
                     { data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'name', name: 'name' },
                      { data: 'reg_no', name: 'reg_no' },
                      { data: 'date_of_admission', name: 'date_of_admission' },
                      {data: 'asessions.name', name: 'asessions.name'},
                      {data: 'created_courses.name', name: 'created_courses.name'},
                      { data: 'father_name', name: 'father_name' },
                      { data: 'mother_name', name: 'mother_name' },
                      {data: 'active', name: 'active', orderable: false, searchable: false},
                      {data: 'profile', name: 'profile', orderable: false, searchable: false},


        ]
    });

    $('#search-formfff').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>


@stop
