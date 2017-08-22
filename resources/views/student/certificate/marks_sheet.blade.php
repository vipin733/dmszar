@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">

  <div class="col-md-4">
    @include('partial.errors')
  	    <button class="btn btn-primary btn-block">Request For Progress Report</button>
  	    <div class="panel panel-default">        
            <div class="panel-body"> 
              <form action="/student/marks_sheet" method="post"  data-parsley-validate ="">    
                    {{ csrf_field() }}       
				    <div class="form-group">
				        <label for="course">Select Course</label>
				        <select class="form-control" id="course" name="course" required="">
				          <option value="">---Select Course</option>
				           @foreach($courses as $course)
				            <option value="{{ $course->courses['id'] }}">{{ $course->courses['name'] }}</option>
				           @endforeach
				        </select>
				     </div> 				         
				    <div class="form-group">
				        <label for="description">Description</label>
				        <textarea class="form-control" id="description" name="description"  placeholder="ex- Provide us progress report of seesion 2012-13">{{ Input::old('description') }}</textarea>
				    </div>
	                
	                <div class="col-sm-8 col-sm-offset-2">
	                	<button class="btn btn-success btn-block">Submit</button>
	                </div> 
              </form>                              
            </div>
        </div>
  </div>

  <div class="col-md-8">
  	    <button class="btn btn-primary btn-block">View Request For Progress Report</button>
  	    <div class="panel panel-default">        
            <div class="panel-body"> 
                   <div class="table-responsive">				       
			            <table class=" table table-bordered  table-hover">			         
			             <thead >
			                <tr>
			                	<th class="text-center">Ticket no.</th>
			                	<th class="text-center">Request Date</th>
			                	<th class="text-center">Course</th>
			                	<th class="text-center">Status</th>
			                	<th class="text-center">View</th>
			                </tr> 
			             </thead>
			             <tbody>
			             @foreach($marksheetrequests as $marksheetrequest)
			             	<tr class="text-center">
			             		<td>{{ $marksheetrequest['ticket_no'] }}</td>
			             		<td>{{ $marksheetrequest['created_at']->format('d/m/Y') }}</td>
			             		<td>{{ $marksheetrequest->courses['name'] }}</td>
			             		<td>
			             			@if($marksheetrequest->status == 1)
			             			 Ready
			             			@else
			             			Awaiting
			             			@endif 
			             		</td>
			             		<td>
			             		 <a href="" data-toggle="modal" data-target="#log_view" class="btn btn-primary btn-xs"> <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
			             		  @include('student.certificate.modal.mark_sheet_modal')
			             		</td>
			             	</tr>
			             @endforeach 	
			             </tbody>			 
			            </table>          
			        </div>                     
            </div>

            {{ $marksheetrequests->links() }}
        </div>
  </div>

</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@stop