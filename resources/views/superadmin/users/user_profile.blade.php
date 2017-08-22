@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')


<div class="row">

    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
               <button class="btn btn-primary btn-block">User Profile Info.</button>
            </div>
            <div class="panel-body">
                <div class="table-responsive text-center">
                    <table class="table table-bordered  table-hover">
                        <thead>
                            <tr>
                            	<th class="text-center">User ID</th>
	                            <td class="text-center">{{ $user->id }}</td>
	                            <th class="text-center">Status</th>
	                            <td class="text-center">
		                            @if($user->isActive())
		                            Active
		                            @else
		                            Deactive
		                            @endif
	                            </td>
                            </tr>

                            <tr>
                            	<th class="text-center">User Name</th>
	                            <td class="text-center">{{ $user->name }}</td>
	                            <th class="text-center">Email</th>
	                            <td class="text-center">{{ $user->email }}</td>
                            </tr>

                             <tr>
                            	<th class="text-center">Plan</th>
	                            <td class="text-center">
	                            	@if($user->plan == 0)
	                            	 Free
	                            	 @else
	                            	 Basic
	                            	@endif
	                            </td>
	                            <th class="text-center">Trial End At</th>
	                            <td class="text-center">{{ $user->trial_end_at->format('d/m/Y') }}</td>
                            </tr>

                            <tr>
                            	<th colspan="1" class="text-center">Mobile No.</th>
	                            <td colspan="3" class="text-center">{{ $user->mobile_no }}</td>
                            </tr>

                            <tr>
                            	<th colspan="1" class="text-center">School App Name</th>
	                            <td colspan="3" class="text-center">{{ $user->appprofile['app_name'] }}</td>
                            </tr>

                            <tr>                            	
	                            <th class="text-center">Student Reg.no. Prefix</th>
	                            <td class="text-center">{{ $user->appprofile['reg_prefix_student'] }}</td>
	                            <th class="text-center">Teacher/staff Reg.no. Prefix</th>
	                            <td class="text-center">{{ $user->appprofile['reg_prefix_teacher'] }}</td>
                            </tr>

                            <tr>
                            	<th class="text-center">School Name</th>
	                            <td class="text-center">{{ $user->schoolprofile['school_name'] }}</td>
	                            <th class="text-center">School Board</th>
	                            <td class="text-center">{{ $user->schoolprofile->schoolboards['name'] }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">School Affiliation No</th>
	                            <td class="text-center">{{ $user->schoolprofile['affiliation_no'] }}</td>
	                            <th class="text-center">School Code</th>
	                            <td class="text-center">{{ $user->schoolprofile['school_code_no'] }}</td>
                            </tr>

                            <tr>
                                <th colspan="1" class="text-center">School Address</th>
	                            <td colspan="3" class="text-center">{{ $user->schoolprofile['school_address'] }}, {{ $user->schoolprofile['city'] }}, {{ $user->schoolprofile->appdistricts['name'] }}, {{ $user->schoolprofile->states['name'] }}, {{ $user->schoolprofile['pincode'] }} </td>
                            </tr>

                            <tr>
                                <th class="text-center">School Email</th>
	                            <td class="text-center">{{ $user->schoolprofile['school_email'] }}</td>
	                            <th class="text-center">School Website</th>
	                            <td class="text-center">{{ $user->schoolprofile['website'] }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">School Telephone No</th>
	                            <td class="text-center">{{ $user->schoolprofile['telephone_no'] }}</td>
	                            <th class="text-center">School Mobile No.</th>
	                            <td class="text-center">{{ $user->schoolprofile['mobile_no'] }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">Main Campus</th>
	                            <td class="text-center">
	                            	@if($user->schoolprofile['main_campuse'] == 1)
	                            	Yes
	                            	@else
	                            	No
	                            	@endif
	                            </td>
	                            <th class="text-center">Hostel Service</th>
	                            <td class="text-center">
	                            	@if($user->schoolprofile['hostel_service'] == 1)
	                            	Yes
	                            	@else
	                            	No
	                            	@endif
	                            </td>
                            </tr>

                            <tr>
                                <th class="text-center">Transport Service</th>
	                            <td class="text-center">
	                            	@if($user->schoolprofile['transport_service'] == 1)
	                            	Yes
	                            	@else
	                            	No
	                            	@endif
	                            </td>
	                            <th class="text-center">School Logo</th>
	                            <td class="text-center">
	                            	@include('superadmin.users.user_school_logo_modal')
	                            </td>
                            </tr>

                             <tr>
                                <th class="text-center">Total No. of Students</th>
	                            <td class="text-center">{{ $students }}</td>
	                            <th class="text-center">Total No. of Active Students</th>
	                            <td class="text-center">{{ $active_students }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">Total No. of Teachers</th>
	                            <td class="text-center">{{ $teachers }}</td>
	                            <th class="text-center">Total No. of Active Teachers</th>
	                            <td class="text-center">{{ $active_teachers }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">Total No. of Staffs</th>
	                            <td class="text-center">{{ $staffs }}</td>
	                            <th class="text-center">Total No. of Active Staffs</th>
	                            <td class="text-center">{{ $active_staffs }}</td>
                            </tr>

                        </thead>
                    </table>
                </div>

                <div class="text-center">
                	<a class="btn btn-primary" href="/superadmin/{{$user->id}}/invoices">Invoices</a>
                </div>

            </div>
        </div>
    </div>
                        
</div>

@stop