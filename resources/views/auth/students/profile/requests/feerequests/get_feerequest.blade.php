@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

<div class="row">

    @include('auth.students.profile.attendence_status_profile')

    <div class="col-md-12">
        <div class="panel panel-default">
		    <div class="panel-heading">
		     <button class="btn btn-primary btn-block">
		     Fee Extension/Refund Requests
		     </button>
		     </div>
            <div class="panel-body">        
 	           <div class="table-responsive">
                <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
		              <tr>
		                <th class="text-center">Serial No.</th>
		                <th class=" text-center">Date</th>
		                <th class="text-center">Ticket No</th>
		                <th class="text-center">Category</th>
		                <th class="  text-center">Status</th>
		                <th class=" text-center">View</th>
		              </tr>
		            </thead>
		            <tbody class="text-center">
		            <?php $i = 0 ?>
		              @foreach($feerequests as $feerequest)
		                <?php $i++ ?>
		                <tr>
		                    <td>{{ $i }}</td>
		                    <td>{{ $feerequest['created_at']->format('d/m/Y') }}</td>
		                    <td>{{ $feerequest['ticket_no'] }}</td>
		                    <td>{{ $feerequest->feerequestcategories['name'] }}</td>
		                    <td>
		                      @if($feerequest->status == 1)
		                         Awaiting
		                         @elseif($feerequest->status == 2)
		                         Aproved
		                        @else
		                        Rejected
		                      @endif 
		                    </td>
		                    <td> 
		                    <a class="btn btn-primary btn-xs" href="">
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
   {{ $feerequests->links() }}
 </div>
   
</div>
@endsection
