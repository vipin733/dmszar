@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

    @include('staff.students.fee.profile_fee_nav.fee_profile_nav')

    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">My Fee Status({{ $activesessionid->name }})</button>
            </div>
            <div class="panel-body">

                <div class="panel-heading">
                    <button class="btn btn-default btn-block">
                       Registration Fee Status({{$user->courses->name or 'N/A'}})
                    </button>
                </div> 
                <div class="table-responsive text-center">
                    <table class="table table-bordered  table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Paid Registration Fee</th>
                                <th class="text-center">Paid Late Fee</th>
                                <th class="text-center">Total Paid Fee</th>
                                <th class="text-center">School Registration Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr class="text-center">
                        	    <td>
                        	        <i class="fa fa-inr" aria-hidden="true"></i> 
                        	        {{ $registration_fee->registraion_fee or '0'}}
                        	    </td>
                            	<td>
                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                        	        {{ $registration_fee->late_fee or '0' }}
                            	</td>
                            	<td>
                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            		{{ $totalpaidRfee or '0'}}
                            	</td>
                            	<td>
                            	    <i class="fa fa-inr" aria-hidden="true"></i>
                            	    {{$registraionfee->registraion_fee or '0'}}
                            	</td>
                        	</tr>
                        </tbody>
                    </table>
                </div>  

                <div class="panel-heading">
                    <button class="btn btn-default btn-block">
                        Tuition Fee Status({{$user->courses->name or 'N/A'}})
                    </button>
                </div> 
                <div class="table-responsive text-center">
                    <table class="table table-bordered  table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Paid Tuition Fee</th>
                                <th class="text-center">Paid Late Fee</th>
                                <th class="text-center">Paid Other Fee</th>
                                <th class="text-center">Total Paid Fee</th>
                                <th class="text-center">School Tuition Fee (12 Month)</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                        	    <td>
                        	        <i class="fa fa-inr" aria-hidden="true"></i> 
                        	        {{ $tution_fee->tution_fee or '0'}}
                        	    </td>
                            	<td>
                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                        	        {{ $tution_fee->late_fee or '0' }}
                            	</td>
                            	<td>
                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                        	        {{ $tution_fee->other_fee or '0' }}
                            	</td>
                            	<td>
                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            		{{ $totalpaidTUfee or '0'}}
                            	</td>
                            	<td>
                            	    <i class="fa fa-inr" aria-hidden="true"></i>
                            	    @if($tutionfee)
                            	     {{ 12 * $tutionfee->tution_fee }}
                            	    @else
                            	    0
                            	    @endif 
                            	</td>
                        	</tr>
                        </tbody>
                    </table>
                </div>

                @if($user->TransportationTaken())
                    <div class="panel-heading">
                        <button class="btn btn-default btn-block">
                            Transport Fee Status({{$user->stopages->name or 'N/A'}})
                        </button>
                    </div> 
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Paid Transport Fee</th>
                                    <th class="text-center">Paid Late Fee</th>
                                    <th class="text-center">Paid Other Fee</th>
                                    <th class="text-center">Total Paid Fee</th>
                                    <th class="text-center">School Transport Fee (12 Month)</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	    <td>
                            	        <i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $transport_fee->transport_fee or '0'}}
                            	    </td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $transport_fee->late_fee or '0' }}
	                            	</td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $transport_fee->other_fee or '0' }}
	                            	</td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
	                            		{{ $totalpaidTTfee or '0'}}
	                            	</td>
	                            	<td>
	                            	    <i class="fa fa-inr" aria-hidden="true"></i>
	                            	    @if($transportfee)
	                            	     {{ 12 * $transportfee->transport_fee }}
	                            	    @else
	                            	    0
	                            	    @endif 
	                            	</td>
                            	</tr>
                            </tbody>
                        </table>
                    </div> 
                @endif

                @if($user->HostelTaken())
                    <div class="panel-heading">
                        <button class="btn btn-default btn-block">
                            Hostel Fee Status({{$user->hostels->name or 'N/A'}})
                        </button>
                    </div> 
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Paid Hostel Fee</th>
                                    <th class="text-center">Paid Late Fee</th>
                                    <th class="text-center">Paid Other Fee</th>
                                    <th class="text-center">Total Paid Fee</th>
                                    <th class="text-center">School Hostel Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	    <td>
                            	        <i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $hostel_fee->hostel_fee or '0'}}
                            	    </td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $hostel_fee->late_fee or '0' }}
	                            	</td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
                            	        {{ $hostel_fee->other_fee or '0' }}
	                            	</td>
	                            	<td>
	                            		<i class="fa fa-inr" aria-hidden="true"></i> 
	                            		{{ $totalpaidHfee or '0'}}
	                            	</td>
	                            	<td>
	                            	    <i class="fa fa-inr" aria-hidden="true"></i>
	                            	    {{$hostelfee->hostel_fee or '0'}}
	                            	</td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>
                @endif                      

            </div>
        </div>
    </div>         
</div>        

@stop