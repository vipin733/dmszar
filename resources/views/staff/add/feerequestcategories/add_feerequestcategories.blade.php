@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
     @include('partial.errors')

 	<div class="col-md-8">
 	    <div class="panel panel-default">
            <div class="panel-heading"><button class="btn btn-primary btn-block">Fee Request Category</button></div>
            <div class="panel-body">
                <div class="table-responsive">
 		            <table class=" table table-bordered  table-hover" data-form="deleteForm">
	                    <thead>
	                        <tr>
				                <th class="text-center">Serial No.</th>
				                <th class="text-center">Fee Request Category Name</th>
				                <th class="text-center">Remarks</th>
				                <th class="text-center">Edit</th>
			                </tr>
			            </thead>
			            <tbody class="text-center">
				            <?php $i = 0 ?>
				            @foreach($feerequestcategories as $feerequestcategory)
				             <?php $i++ ?>
				              <tr>
				                  <td>{{ $i }}</td>
				                  <td>{{ $feerequestcategory->name }}</td>
				                  <td>
				                  	@if($feerequestcategory->remarks)
				                  	 {{$feerequestcategory->remarks}}
				                  	 @else
				                  	 N/A
				                  	@endif
				                  </td>
				                  <td>@include('staff.add.feerequestcategories.feerequestcategories_update_modal')</td>
				              </tr>
				            @endforeach
			            </tbody>
                    </table>
	            </div>
	        </div>
	    </div>   
	  {{ $feerequestcategories->links() }}
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><button class="btn btn-primary btn-block">Fee Request Category</button></div>
            <div class="panel-body">
			  	<form method="POST" action="{{ route('feerequestcategories.store') }}" data-parsley-validate ="">
			     {{ csrf_field() }}
			        <div class="form-group">
			          <label class="control-label" for="name">Fee Request Category Name</label>
			          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required="" placeholder="ex-Fee refund, fee extension">
			        </div>
			        <div class="form-group">
			            <label class="control-label" for="remarks">Remarks</label>
			            <textarea type="text" class="form-control" placeholder="" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
			        </div>
			        <div class="form-group">    
			         <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Add Category</button>
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
