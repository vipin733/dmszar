@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

 <div class="row">
   @include('partial.errors')

    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">Bank Details</button>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
 		        <table class=" table table-bordered  table-hover" data-form="deleteForm">
	                <thead>
	                    <tr>
	                        <th class="text-center">Serial No.</th>
	                   	    <th class="text-center">Bank Name</th>
	                   	    <th class="text-center">Branch Name</th>
	                   	    <th class="text-center">Bank Address</th>
	                   	    <th class="text-center">Bank Account No.</th>
	                   	    <th class="text-center">Bank Account Name</th>
	                   	    <th class="text-center">Bank IFCS Code</th>
	                   	    <th class="text-center">Bank MICR Code</th>
	                   	    <th class="text-center">Description</th>
	                   	    <th class="text-center">Action</th>
	                    </tr>
	                </thead>
	                <tbody class="text-center">
	                 <?php $i = 0 ?>
	                  @foreach($bankdetails as $bankdetail)
	                  <?php $i++ ?>
	                	<tr>
	                		<td>{{ $i }}</td>
	                		<td>{{$bankdetail->banknames['name'] }}</td>
	                		<td>{{$bankdetail['branch_name'] }}</td>
	                		<td>
		                		@if($bankdetail['bank_address'])
		                		{{$bankdetail['bank_address'] }}
		                		@else
		                		N/A
		                		@endif
	                		</td>
	                		<td>{{$bankdetail['bank_acc'] }}</td>
	                		<td>{{$bankdetail['bank_acc_name'] }}</td>
	                		<td>{{$bankdetail['bank_ifcs_code'] }}</td>
	                		<td>
		                		@if($bankdetail['bank_micr_code'])
		                		{{$bankdetail['bank_micr_code'] }}
		                		@else
		                		N/A
		                		@endif
	                		</td>
	                		<td>
		                		@if($bankdetail['description'])
		                		{{$bankdetail['description'] }}
		                		@else
		                		N/A
		                		@endif
	                		</td>
	                		<td>
	                		  @include('auth.onlinetransfer.bank.bank_details_update_modal')
	                		   @include('auth.onlinetransfer.bank.bank_detail_delete')
	                		</td>
	                	</tr>
	                  @endforeach		
	                </tbody>
	            </table>
	        </div>                  
        </div>
      </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <button class="btn btn-primary btn-block">Bank Details Form</button>
        </div>
        <div class="panel-body">
            <form action="/auth/bank_details/post" method="post" data-parsley-validate ="">
             {{ csrf_field() }}
	           	<div class="form-group">
	              <label class="control-label" for="bank_name">Select Bank Name</label>
	              <select class="form-control" id="bank_name" name="bank_name" required="">
		            <option value="">---Select Bank</option>
		             @foreach($banknames as $key=>$value)
		             @if (Input::old('bank_name') == $key)
		             <option value="{{ $key }}" selected>{{ $value }}</option>
		             @else
		             <option value="{{ $key }}">{{ $value }}</option>
		             @endif
		             @endforeach
		           </select>
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="branch_name">Bank Branch Name</label>
	              <input type="text" class="form-control" value="{{ old('branch_name') }}" placeholder="ex- Baragon" name="branch_name" id="branch_name" required="">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="bank_address">Bank Address</label>
	              <textarea class="form-control"  name="bank_address" id="bank_address" required="">{{ old('bank_address') }}</textarea>
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="bank_acc">Bank Account No.</label>
	              <input type="text" class="form-control" placeholder="ex- 99999999999999" value="{{ old('bank_acc') }}" name="bank_acc" id="bank_acc" required="">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="bank_acc_name">Bank Account Name</label>
	              <input type="text" class="form-control" placeholder="ex- Gramyancha Mahila Vidyalaya" value="{{ old('bank_acc_name') }}" name="bank_acc_name" id="bank_acc_name" required="">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="bank_ifcs_code">Bank IFCS Code</label>
	              <input type="text" class="form-control" placeholder="ex- SBIN00025" value="{{ old('bank_ifcs_code') }}" name="bank_ifcs_code" id="bank_ifcs_code" required="">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="bank_micr_code">Bank MICR Code(Optional)</label>
	              <input type="text" class="form-control" value="{{ old('bank_micr_code') }}" name="bank_micr_code" id="bank_micr_code">
	            </div>
	            <div class="form-group">
	              <label class="control-label" for="description">Description(Optional)</label>
	              <textarea type="text" class="form-control"  name="description" id="description">{{ old('description') }}</textarea>
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
