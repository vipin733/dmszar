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
                <b>Total Active Students</b>
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

              <form  method="post" class="form-inline" id="search-formfff">

                <div class="form-group">
                  <select  id="course" class="form-control" name="course">
                    <option value="">---Select Class</option>
                   @foreach($courses as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                 <div class="form-group">
                  <select  id="section" class="form-control" name="section">
                    <option value="">---Select Section</option>
                   @foreach($sections as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>


                <div class="form-group">
                  <select  id="session" class="form-control" name="session">
                    <option value="">---Select Session</option>
                   @foreach($asessions as $key=>$value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>

                 <div class="form-group">
                   <button class="btn btn-primary" type="submit">Submit</button>
                 </div>

                 <div class="form-group">
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
                <th class="text-center">Date of admission</th>
                <th class="text-center">Session</th>
                <th class="text-center">Class</th>
                <th class="text-center">Section</th>
                <th class="text-center">Roll No.</th>
                <th class="text-center">Father Name</th>
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
            url: '/st/active/students_ajax',
            data: function (d) {

                d.course              = $('select[name=course]').val();                
                d.section             = $('select[name=section]').val();
                d.session             = $('select[name=session]').val();
               

            }
        },

        columns: [
                      { data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'students.name', name: 'students.name' },
                      { data: 'students.reg_no', name: 'students.reg_no' },
                      { data: 'date_of_admission', name: 'date_of_admission' },
                      {data: 'asessions.name', name: 'asessions.name'},
                      {data: 'courses.name', name: 'courses.name'},
                      {data: 'sections.name', name: 'sections.name'},
                      { data: 'rollno', name: 'rollno' },
                      { data: 'students.father_name', name: 'students.father_name' },
                      {data: 'profile', name: 'profile', orderable: false, searchable: false},


        ]
    });

    $('#search-formfff').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>


@stop
