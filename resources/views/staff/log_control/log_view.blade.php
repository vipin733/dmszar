@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">

        <div class="col-md-8">
          	<div class="panel panel-default">
          	   <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>Complain Details</b>
			   </button>
		       </div>
			  <div class="panel-body">

			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >          
			                 <tr>
			                  <th class="col-sm-3">Reg. No.</th>
			                  <td>
			                  	 
			                    @if($logrequest->student_id)
			                      <a href="/st/student/{{ $logrequest->students['reg_no'] }}">{{ $logrequest->students['reg_no'] }}</a>
			                    @else
			                      <a href="/st/teacher_staff/{{ $logrequest->teachers['reg_no'] }}">{{ $logrequest->teachers['reg_no'] }}</a>
			                    @endif
			                    
			                  </td>
			                 </tr>
			                 <tr>
			                 <tr>
			                  <th class="col-sm-3">Created Date</th>
			                  <td>{{$logrequest['created_at']->format('d/m/Y')}}</td> 
			                 </tr>
			                 @if(!$logrequest['created_at'] == $logrequest['updated_at'])
			                      <tr>
					                  <th class="col-sm-3">Updated Date</th>
			             	 		<td>{{ $logrequest['updated_at']->format('d/m/Y h:i A') }}</td>             
					               </tr>          
			             	 @endif
			                 <tr>
			                  <th class="col-sm-3">Category</th>
			                  <td>{{ $logrequest->logrequestcategories['name'] }}</td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Subject</th>
			                  <td>{{$logrequest['subject']}}</td> 
			                 </tr>
			                  <tr>
			                  <th class="col-sm-3">Description</th>
			                  <td>
			                    @if($logrequest['description'])
			                    {{$logrequest['description']}}
			                    @else
			                    N/A
			                    @endif
			                  </td> 
			                 </tr> 
			                 <tr>
			                  <th>Status</th>
			                 	<td>
			                       @if($logrequest->status == 1)
			                       Close
			                       @else
			                       Open
			                       @endif
			                    </td>
			                 </tr>
			                 @if($logrequest->action_taker_id)
			                 <tr>
			                 	<th>Updated By</th>
			                 	<td>{{ $logrequest->action_taker['name']}}({{ $logrequest->action_taker['reg_no']  }})
			                 	</td>
			                 </tr>
			                  @endif
			                  @if($logrequest['remarks'])	
			                 <tr>
			                 	<th>Remarks</th>
			                 	<td>{{$logrequest['remarks']}}</td>
			                 </tr>
			                @endif                         			                              
			             </thead>			 
			          </table>
			                   
			    </div>
			  </div>
		    </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">      	  
                    <div class="panel-heading">
					    <button class="btn btn-primary btn-block">
					     <b>Action</b>
					    </button>
				      </div>
				    <div class="panel-body">  
				      <form method="post" action="/staff/teacher_students/logs/{{$logrequest['ticket_no']}}/{{$logrequest['id']}}/{{strtotime($logrequest['created_at'])}}/save" data-parsley-validate ="">
				           {{ csrf_field() }}
					      	<div class="form-group">
					      	    <label>Status</label>
					      		<select class="form-control" name="status" required="">
					      		 @if($logrequest['status'] == 0)
					      			<option value="0">Open</option>
					      			<option value="1">Close</option>
					      	     @else
					      	     <option value="1">Close</option>
					      	     <option value="0">Open</option>
					      	     @endif		
					      		</select>
					      	</div>
					      	<div class="form-group">
						      	<label for="remarks">Remarks</label>
						      	<textarea class="form-control" name="remarks">{{old('remarks',$logrequest->remarks)}}</textarea>
						     </div>
						     <div>
						     	<button type="submit" class="btn btn-success btn-block">
						     		Submit
						     	</button>
						     </div>
					   </form>
					</div>   
				</div>	   
        </div>				      

    </div>

@stop  

@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
  @include('staff.add.destroy_modal_javascript')
@stop
