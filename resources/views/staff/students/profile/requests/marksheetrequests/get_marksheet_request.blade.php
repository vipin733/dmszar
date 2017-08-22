@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                      <button class="btn btn-primary btn-block">Student Information</button>
                </div>
                <div class="panel-body">
                      <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                              <th class="text-center">Reg No.</th>
                              <th  class="text-center">Student Name</th>
                              <th  class="text-center">Father Name</th>
                              <th class="text-center">View Profile</th>                          
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $student['reg_no'] }}</td>
                               <td>{{ $student['name'] }}</td>
                               <td>{{ $student['father_name'] }}</td>
                               <td>
                               <a href="/st/student/{{$student['reg_no']}}" class="btn btn-primary">
                               <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                               </a>
                               </td>
                             </tr>
                           </tbody>
                        </table>
                      </div>
                </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
  		      <div class="panel-heading">
  		        <button class="btn btn-primary btn-block">
  		        Mark sheet Requests
  		      </button>
  		      </div>
            <div class="panel-body">        
 	            <div class="table-responsive">
                  <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
		                  <tr>
    		                <th class="text-center">Serial No.</th>
                        <th class=" text-center">Request Date</th>
                        <th class="text-center">Ticket No</th>
                        <th class="  text-center">Status</th>
                        <th class=" text-center">View</th>
    		              </tr>
		                </thead>
    		            <tbody class="text-center">
    		            <?php $i = 0 ?>
                      @foreach($marksheetrequests as $marksheetrequest)
                        <?php $i++ ?>
                        <tr>
                            <td>{{  $i }}</td>
                            <td>{{ $marksheetrequest['created_at']->format('d/m/Y') }}</td>
                            <td>{{ $marksheetrequest['ticket_no'] }}</td>
                            <td>
                               @if($marksheetrequest->status == 1)
                                 Ready
                                @else
                                Awaiting
                              @endif 
                            </td>
                            <td> 
                            <a class="btn btn-primary btn-xs" href="/staff/student/{{$marksheetrequest['ticket_no']}}/{{$marksheetrequest['id']}}/{{strtotime($marksheetrequest['created_at'])}}/mark_sheet_view">
                             <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            </td>
                        </tr>
                       @endforeach   
    		            </tbody>
                  </table>
              </div>
            </div>
        </div> 
        {{ $marksheetrequests->links() }}
    </div>

</div>
@endsection
