@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')


<div class="row">
 @if($users)

    <div class="col-md-4 col-md-offset-4">

          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-primary btn-block">
                <b>Total Users</b>
              </button>
            </div>  
            <div class="panel-body text-center">
              <h1><strong>{{$users}}</strong></h1>
            </div>
          </div>    
    </div>   
      <br>   
 

  <div class="col-md-12 studentprofile">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         <b>Users Information</b>
        </button>
      </div>  
      <div class="panel-body"> 
       
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover" id="users">
            <thead>
              <tr>
                <th class="text-center">Serial No</th>
                <th class="text-center">User Name</th>
                <th class="text-center">User ID</th>
                <th class="text-center">School Name</th>
                <th class="text-center">School District</th>
                <th class="text-center">Status</th>
                <th class="text-center">Profile</th>
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
  <h1 class="text-center">No Users Found!</h1>
 @endif
</div>


@stop

@section('script')
   
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
   var oTable = $('#users').DataTable({
     processing: true,
     serverSide: true,
     dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: {
            url: '/superadmin/users_ajax',
        },

        columns: [
                     { data: 'Serial_No', name: 'Serial_No' , orderable: false, searchable: false},
                      { data: 'id', name: 'id' },
                      { data: 'name', name: 'name' },
                      {data: 'schoolprofile.school_name', name: 'schoolprofile.school_name'},
                      {data: 'schoolprofile.appdistricts.name', name: 'schoolprofile.appdistricts.name'},
                      {data: 'active', name: 'active', orderable: false, searchable: false},
                      {data: 'profile', name: 'profile', orderable: false, searchable: false},


        ]
    });

</script>


@stop
