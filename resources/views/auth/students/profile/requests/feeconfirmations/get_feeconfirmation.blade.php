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
		     Online Fee Confirmation Requests
		     </button>
		</div>
        <div class="panel-body">        
 	        <div class="table-responsive">
                <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
		              <tr>
		                <th class="text-center">Serial No.</th>
		                <th class="text-center">Class</th>
		                <th class="col-sm-1 text-center">Date</th>
		                <th class="text-center">Ticket No</th>
		                <th class="col-sm-2 text-center">Transaction no.</th>
		                <th class="col-sm-1  text-center">Bank</th>
		                <th class="col-sm-1 text-center">Total</th>
		                <th class="col-sm-1 text-center">Status</th>
		              </tr>
		            </thead>
		            <tbody class="text-center">
		            <?php $i = 0 ?>
		            @foreach($feeconfirmations as $feeconfirmation)
		            <?php $i++ ?>
		            	<tr>
		            		<td>{{ $i }}</td>
			                <td>{{ $feeconfirmation->courses['name'] }}</td>
			                <td class="col-sm-1">{{ $feeconfirmation['created_at']->format('d/m/Y') }}</td>
			                <td> {{ $feeconfirmation['ticket_no'] }}</td>
			                <td class="col-sm-2"> {{ $feeconfirmation['transaction_no'] }}</td>
			                <td class="col-sm-1">SBI/NEFT</td>
			                <td class="col-sm-1"> <i class="fa fa-inr" aria-hidden="true"></i>  {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['development_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] 
		                        }}
		                    </td>
		                  <td>
		                    @if($feeconfirmation->status == 1)
		                        Close
		                        @else
		                        Open
		                    @endif
		                  </td>
			                
		            	</tr>
		               @endforeach  
		            </tbody>
                </table>
            </div>
        </div>
    </div> 
   {{ $feeconfirmations->links() }}
 </div>
   
</div>
@endsection
