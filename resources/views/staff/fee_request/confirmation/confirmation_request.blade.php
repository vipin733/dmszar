@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="panel panel-default">
	    <div class="panel-heading">
	     <button class="btn btn-primary btn-block">
	     Online Fee Confirmation Requests
	     </button>
	    </div>
     <div class="panel-body">

          <div class="text-center col-md-12"  id="sandbox-container">
           	<form method="" id="search-form" class="form-inline" role="form">
  	     	 <div class="input-daterange form-group input-group" id="datepicker">
  	     	    <span class="input-group-addon">From</span>
  			    <input type="text" class="input-sm form-control" id="from" name="from">
  			    <span class="input-group-addon">to</span>
  			    <input type="text" class="input-sm form-control" id="to" name="to">
  		     </div>

  		       <div class="form-group">
  			      <select  id="course" class="form-control" name="course" >
  		                <option value="">---Select Course</option>
  		               @foreach($courses as $key=>$value)
  		                <option value="{{ $key }}">{{ $value }}</option>
  		                @endforeach
  		          </select>
  		        </div>
             
  	        <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
             </form>
            </div>

          <div class="col-md-8 col-md-offset-2">
          <br>
             <form method="get">
              <input name="query" class="form-control" placeholder="Search...">
           </form>
          </div>
          
        

 	    <div class="table-responsive col-md-12">
      <br>
          <table class=" table table-bordered  table-hover" id="userstable">
            <thead>
              <tr>
                <th class="text-center">Serial No.</th>
                <th class="col-sm-2 text-center">Reg. No.</th>
                <th class="text-center">Course</th>
                <th class="col-sm-1 text-center">Date</th>
                <th class="text-center">Ticket No</th>
                <th class="col-sm-2 text-center">Transaction no.</th>
                <th class="col-sm-1  text-center">Bank/App</th>
                <th class="col-sm-1 text-center">Total</th>
                <th class="col-sm-1 text-center">Status</th>
                <th class="col-sm-1 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
            <?php $i = 0 ?>
            @foreach($feeconfirmations as $feeconfirmation)
            <?php $i++ ?>
            	<tr>
            		<td>{{ $i }}</td>
	                <td class="col-sm-2">{{ $feeconfirmation->students['reg_no'] }}</td>
	                <td>{{ $feeconfirmation->courses['name'] }}</td>
	                <td class="col-sm-1">{{ $feeconfirmation['created_at']->format('d/m/Y') }}</td>
	                <td> {{ $feeconfirmation['ticket_no'] }}</td>
	                <td class="col-sm-2"> {{ $feeconfirmation['transaction_no'] }}</td>
	                <td class="col-sm-1">
                   @if($feeconfirmation->bank_name_id)
                        {{ $feeconfirmation->banknames['name'] }}
                        @else
                         {{ $feeconfirmation->appnames['name'] }}
                    @endif 
                  </td>
	                <td class="col-sm-1"> <i class="fa fa-inr" aria-hidden="true"></i>  {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['development_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] 
                        }}</td>
                  <td>
                    @if($feeconfirmation->status == 1)
                        Close
                        @else
                        Open
                    @endif
                  </td>
	                <td class="col-sm-1">
	                 <a class="btn btn-primary btn-xs" href="/staff/students/confirmation_request/{{$feeconfirmation['ticket_no']}}/{{$feeconfirmation['id']}}/{{strtotime($feeconfirmation->created_at)}}/view">
                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                    </a>
                  </td>
            	</tr>
            @endforeach  
            </tbody>
          </table>
        </div>
   </div>
 </div>
  
   {{ $feeconfirmations->appends(request()->only(['from','to','course','query']))->links() }}
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){
        $('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    forceParse: false,
    autoclose: true
});
           $('#search-form').on('submit', function(e) {
               oTable.draw();
               e.preventDefault();
           });
     
})
</script>   

  @stop 