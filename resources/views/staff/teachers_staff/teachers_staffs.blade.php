@extends('layouts.app')
@section('nav')
@if(Auth::guard('teacher')->check())
@include('staff.staff_nav')
@else
@include('layouts.nav')
@endif
@stop
@section('content')

<div class="row">
  @if($teachers)

  <div class="col-md-4 text-center">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         <b>Total Teacher/Staff</b>
        </button>
      </div>  
      <div class="panel-body"> 
        <h1><strong>{{$teachers}}</strong></h1>
      </div>
    </div>  
  </div>


  <div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">
            <b>Search Teacher/Staff</b>
          </button>
        </div>  
        <div class="panel-body text-center">
          <form action="" method="post" class="form-inline" id="search-formfff">

             <div class="form-group">
              <select  id="year_of_joining" class="form-control" name="year_of_joining">
                <option value="">---Select Year</option>
               @foreach($years as $year)
                <option value="{{ $year->date_of_joining->format('Y') }}">{{ $year->date_of_joining->format('Y') }}</option>
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

    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         <b>Teacher/Staff Information</b>
        </button>
      </div>  
      <div class="panel-body"> 
          <div class="table-responsive text-center">
          <table class="table table-bordered table-hover" id="teachers">
            <thead>

              <tr>
                <th class="text-center">Serial No.</th>
                <th class="text-center">Date Of Joining</th>
                <th class="text-center">Teacher Name</th>
                <th class="text-center">Reg. No.</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Mother Name</th>
                <th class="text-center">Type</th>
                <th class="text-center">Status</th>              
                <th class="text-center">View Profile</th>
              </tr>

            </thead>
            
           </table>
         </div>
      </div>
  @else
  <h1 class="text-center">No Teacher/staff Found!</h1>
  @endif
</div>

@stop

@section('script')

<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
   var oTable = $('#teachers').DataTable({
     processing: true,
     serverSide: true,
     dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '/st/all_teachers_staffs/ajax',
            data: function (d) {
              
               d.year_of_joining        = $('select[name=year_of_joining]').val();
               

            }
        },

        columns: [
                      {data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'date_of_joining', name: 'date_of_joining' },
                      {data: 'reg_no', name: 'reg_no' },
                      {data: 'name', name: 'name'},                     
                      {data: 'father_name', name: 'father_name'},
                      {data: 'mother_name', name: 'mother_name'},
                      {data: 'type', name: 'type'},
                      {data: 'status', name: 'status'},
                      {data: 'profile', name: 'profile' , orderable: false, searchable: false},


        ]
    });

    $('#search-formfff').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });

  
</script>


@stop

