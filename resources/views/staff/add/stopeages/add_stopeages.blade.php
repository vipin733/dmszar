@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
     @include('partial.errors')

 	<div class="col-md-8">
 	    <div class="panel panel-default">
	        <div class="panel-heading"><button class="btn btn-primary btn-block">Stoppages</button></div>
	        <div class="panel-body">
	            <div class="table-responsive">
	 		        <table class="table table-bordered  table-hover" data-form="deleteForm">
			            <thead>
		                  <tr>
			                <th class="text-center">Serial No.</th>
			                <th class="text-center">Stoppage Name</th>
			                <th class="text-center">Bus Name</th>
			                <th class="text-center">Remarks</th>
			                <th class="text-center">Edit</th>
			              </tr>
			            </thead>
			            <tbody class="text-center">
			            <?php $i = 0 ?>
			            @foreach($stopeages as $stopeage)
			             <?php $i++ ?>
			              <tr>
			                  <td>{{ $i }}</td>
			                  <td>{{ $stopeage->name }}</td>
			                  <td>@include('staff.add.stopeages.stopeages_busdetail_modal')</td>
			                  <td>
			                      @if($stopeage->remarks)
				                   {{ $stopeage->remarks }}
				                   @else
				                   N/A
				                   @endif
				               </td>
			                  <td>@include('staff.add.stopeages.stopeages_update_modal')</td>
			              </tr>
			            @endforeach
			            </tbody>
	                </table>
		        </div>
	        </div>
	    </div>
         {{ $stopeages->links() }}
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
	        <div class="panel-heading"><button class="btn btn-primary btn-block">Stoppages</button></div>
	        <div class="panel-body">
		  	    <form method="POST" action="{{ route('stopages.store') }}" data-parsley-validate ="">
		        {{ csrf_field() }}
			       <div class="form-group">
			          <label class="control-label" for="name">Stoppage Name</label>
			          <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" required="">
			        </div>
			        <div class="form-group">
			           <label class="control-label" for="bus_detail">Bus(select bus which suitable for this stoppage)</label>
		                <select  id="bus_detail" class="form-control" name="bus_detail" >
		                    <option value="">---Select Bus </option>
		                    @foreach($busdetails as $key=>$value)
		                      <option value="{{ $key }}">{{ $value }}</option>
		                    @endforeach
		                </select>
		            </div>
		            <div class="form-group">
			            <label class="control-label" for="remarks">Remarks:</label>
			            <textarea type="text" class="form-control" placeholder="" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
			        </div>
			        <div class="form-group">  
			         <button type="submit" class=" btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Add Stoppage</button>
			        </div>
		        </form>
		    </div> 
		</div>    
    </div>

</div>

@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript">
  	
  </script>
  @include('staff.add.destroy_modal_javascript')
  @stop
