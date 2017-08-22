@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
  <div class="row">
  	<div class="col-sm-8">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Online fee confirmation request</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            
                           <tr>
                            	<td colspan="2">
                            		<button class="btn btn-primary btn-xs btn-block">
			                         Transaction Details
			                        </button>
                            	</td>
                            </tr>

                             <tr>
                                 <th class="text-center">Registration no</th>
                                 <td class="text-center">{{ $feeconfirmation->students['reg_no']}}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">Course</th>
                                 <td class="text-center">{{ $feeconfirmation->courses['name']}}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">Request Date</th>
                                 <td class="text-center">{{ $feeconfirmation['created_at']->format('d/m/Y')}}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">Deposit Date</th>
                                 <td class="text-center">{{ $feeconfirmation['deposit_date']->format('d/m/Y')}}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">
                                   @if($feeconfirmation->bank_name_id)
                                    Bank Name
                                    @else
                                    Wallet/App Name
                                    @endif
                                 </th>
                                 <td class="text-center">
                                   @if($feeconfirmation->bank_name_id)
                                      {{ $feeconfirmation->banknames['name'] }}
                                      @else
                                       {{ $feeconfirmation->appnames['name'] }}
                                  @endif
                                 </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Ticket No.</th>
                                 <td class="text-center">{{ $feeconfirmation['ticket_no'] }}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">Transaction no.</th>
                                 <td class="text-center">{{ $feeconfirmation['transaction_no'] }}</td>
                             </tr>
                             <tr>
                                 <th class="text-center">Status</th>
                                 <td class="text-center">
                                   @if($feeconfirmation->status == 1)
                                      Close
                                      @else
                                      Open
                                  @endif
                                 </td>
                             </tr>
                               @if(!$feeconfirmation->created_at == $feeconfirmation->updated_at)
                              <tr>
                                 <th class="text-center">Updated At</th>
                                 <td class="text-center">
                                    {{ $feeconfirmation['updated_at']->format('d/m/Y h:i A') }}
                                 </td>
                             </tr>
                              @endif
                              @if($feeconfirmation->taken_by_id)
                               <tr>
                                 <th class="text-center">Updated By</th>
                                 <td class="text-center">
                                   {{ $feeconfirmation->action_taken_by['name'] }}({{ $feeconfirmation->action_taken_by['reg_no'] }})
                                 </td>
                              </tr>
                             @endif
                             @if($feeconfirmation->reply)
                             <tr>
                                 <th class="text-center">Remarks Given</th>
                                 <td class="text-center">
                                   {{ $feeconfirmation['reply'] }}
                                 </td>
                             </tr>
                            @endif 
                             <tr>
                            	<td colspan="2">
                            		<button class="btn btn-primary btn-xs btn-block">
			                         Nature of Fee Deposit
			                        </button>
                            	</td>
                            </tr>

                            <tr>
                                 <th class="text-center">Tuition Fee</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                                 @if($feeconfirmation['tution_fee']) 
                                  {{ $feeconfirmation['tution_fee'] }}
                                  @else
                                   0
                                   @endif
                                 </td>
                             </tr>

                             <tr>
                                 <th class="text-center">Transport Fee</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                                  @if($feeconfirmation['transport_fee']) 
                                  {{ $feeconfirmation['transport_fee'] }}
                                  @else
                                   0
                                   @endif
                                 </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Hostel Fee</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                                  @if($feeconfirmation['hostel_fee']) 
                                  {{ $feeconfirmation['hostel_fee']}}
                                  @else
                                  0
                                   @endif
                                </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Registration Fee </th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i>
                                   @if($feeconfirmation['registration_fee']) 
                                  {{ $feeconfirmation['registration_fee']}}
                                  @else
                                   0
                                   @endif 
                                 </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Late Fee</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i>
                                   @if($feeconfirmation['late_fee']) 
                                  {{ $feeconfirmation['late_fee']}}
                                  @else
                                   0
                                   @endif 
                                 </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Other Fee</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                                   @if($feeconfirmation['other_fee']) 
                                  {{ $feeconfirmation['other_fee']}}
                                  @else
                                   0
                                   @endif 
                                 </td>
                             </tr>
                              <tr>
                                 <th class="text-center">Total</th>
                                 <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                                    {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['registration_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] 
                                     }}
                                 </td>
                             </tr>
                             <tr>
                                 <th class="text-center">Remarks By Student</th>
                                 <td class="text-center">
                                   @if($feeconfirmation['remarks'])
                                    {{ $feeconfirmation['remarks'] }}
                                   @else
                                   N/A
                                   @endif 
                                 </td>
                             </tr>

                            </thead>                  
                        </table>
                      </div>
                      
                </div>
           </div>        
       </div>

    <div class="col-md-4">
        <div class="panel panel-default">
              <div class="panel-heading">
              <button class="btn btn-primary btn-block">Online fee confirmation request</button>
              </div>
              <div class="panel-body"> 
                      <form action="/staff/students/confirmation_request/{{$feeconfirmation['ticket_no']}}/{{$feeconfirmation['id']}}/{{strtotime($feeconfirmation->created_at)}}/save" method="post" data-parsley-validate ="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                          <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form-control" name="status">
                                @if($feeconfirmation['status'] == 0)
                                  <option value="0">Open</option>
                                  <option value="1">Close</option>
                                  @else
                                  <option value="1">Close</option>
                                  <option value="0">Open</option>
                                  @endif
                              </select>
                          </div>
                          
                          <div class="form-group">
                            <label for="reply">Give Remarks</label>
                            <textarea type="text" name="reply" class="form-control"></textarea>
                          </div>

                          <div class="form-group">
                              <button type="submit" class="btn btn-block btn-primary">Submit</button>
                          </div>
                      </form>
                       <a href="/student/{{$feeconfirmation->students['reg_no']}}/{{$feeconfirmation->students['uuid']}}/tution_fee/take">
                        <button class="btn btn-block btn-success">Pay Fee</button>
                        </a>
              </div>        
        </div>                
    </div>   
  </div>
@endsection


@section('script')
<script type="text/javascript" src = "/js/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@endsection