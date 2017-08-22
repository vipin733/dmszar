@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

 <div class="row">
  @include('partial.errors')

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">App Details</button>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
 		        <table class=" table table-bordered  table-hover" data-form="deleteForm">
	                <thead>
	                    <tr>
	                        <th class="text-center">Serial No.</th>
	                   	    <th class="text-center">App Name</th>
	                   	    <th class="text-center">App ID</th>
	                   	    <th class="text-center">Description</th>
	                   	    <th class="text-center">QR Code</th>
	                   	    <th class="text-center">Action</th>
	                    </tr>
	                </thead>
	                <tbody class="text-center">
	                <?php $i = 0 ?>
	                  @foreach($appdetails as $appdetail)
	                  <?php $i++ ?>
	                	<tr>
	                		<td>{{ $i }}</td>
	                		<td>{{$appdetail->appnames['name'] }}</td>
	                		<td>{{$appdetail['app_id'] }}</td>
	                		<td>
	                		@if($appdetail['description'])
	                		{{$appdetail['description'] }}
	                		@else
	                		N/A
	                		@endif
	                		</td>
	                		<td>@include('auth.onlinetransfer.app.qr_modal')</td>
	                		<td>
	                		 @include('auth.onlinetransfer.app.app_details_update_modal')
	                		 @include('auth.onlinetransfer.app.app_detail_delete')
	                		</td>
	                	</tr>
	                @endforeach	
	                </tbody>
	            </table>
	        </div>                  
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">App Details Form</button>
        </div>
        <div class="panel-body">
            <form action="/auth/app_details/post" method="post" data-parsley-validate ="" enctype="multipart/form-data">
             {{ csrf_field() }}
	           	<div class="form-group">
	              <label class="control-label" for="app_name">Select App Name</label>
	              <select class="form-control" id="app_name" name="app_name" required="">
		            <option value="">---Select App</option>
		             @foreach($appnames as $key=>$value)
		             @if (Input::old('app_name') == $key)
		             <option value="{{ $key }}" selected>{{ $value }}</option>
		             @else
		             <option value="{{ $key }}">{{ $value }}</option>
		             @endif
		             @endforeach
		           </select>
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="app_id">App ID</label>
	              <input type="text" class="form-control" placeholder="ex- 78888888888@upi" name="app_id" id="app_id" required="">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="qr_code">QR Code</label>
	              <input type="file" name="qr_code" id="qr_code">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="description">Description(Optional)</label>
	              <textarea type="text" class="form-control" name="description" id="description"></textarea>
	            </div>
                <div class="form-group">
	              <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
