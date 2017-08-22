@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

 <div class="row">
   @include('partial.errors')
 	<div class="col-md-8">
 	<div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Sessions</button></div>
          <div class="panel-body">
           <div class="table-responsive">
 		     <table class=" table table-bordered  table-hover" data-form="deleteForm">
	            <thead>
	              <tr>
	                <th class="text-center">Serial No.</th>
	                <th class="text-center">Session</th>
	                <th class="text-center">Status</th>
	                <th class="text-center">Remarks</th>
	                <th class="text-center">Edit</th>
	              </tr>
	            </thead>
	            <tbody class="text-center">
	            <?php $i = 0 ?>
	            @foreach($asessions as $asession)
	             <?php $i++ ?>
	              <tr>
	                  <td>{{ $i }}</td>
	                  <td>{{ $asession->name }}</td>
	                  <td>
	                  	@if($asession->isActive())
	                  	 Active
	                  	 @else
	                  	 De-active
	                  	 @endif
	                  </td>
	                  <td>
	                  	@if($asession->remarks)
	                  	 {{$asession->remarks}}
	                  	 @else
	                  	 N/A
	                  	 @endif
	                  </td>
	                  <td>
	                    @include('auth.add.asessions.asessions_update_modal')
	                  </td>
	              </tr>
	            @endforeach
	            </tbody>

	         </table>
	        </div>
	       </div>
	    </div>   
	  {{ $asessions->links() }}
    </div>

    <div class="col-md-4">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <button class="btn btn-primary btn-block">Sessions Create Form</button>
	        </div>
	        <div class="panel-body">

                <form method="POST" action="{{ route('asessions_auth.store') }}" data-parsley-validate ="">
			     {{ csrf_field() }}

			          <div class="form-group">
			            <label class="control-label" for="name">Session</label>
			            <input type="text" class="form-control" placeholder="ex-2017-2018" name="name" id="name" required="">
			          </div>

			          <div class="form-group">
				        <label for="active">Status</label>
				           <select name="active" class="form-control" required="">
				            <option value="0">De-active</option>
				             <option value="1">Active</option>
				            </select>
				      </div>

				       <div class="form-group">
			             <label class="control-label" for="remarks">Remarks</label>
			             <textarea type="text" class="form-control" placeholder="" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
			          </div>

				      <div class="form-group">
			           <button type="submit" class=" btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Add Session</button>
			         </div>
			     
			    </form>

	        </div>
	    </div>
	</div>         	 


</div>

@stop
@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop
